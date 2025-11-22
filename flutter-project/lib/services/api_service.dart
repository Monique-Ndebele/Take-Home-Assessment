import 'dart:convert';
import 'package:http/http.dart' as http;
import '../config/api_config.dart';
import '../models/user.dart';
import '../models/product.dart';
import '../models/order.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ApiService {
  // Get saved token
  Future<String?> _getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('auth_token');
  }

  // Save token
  Future<void> _saveToken(String token) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('auth_token', token);
  }

  // Remove token
  Future<void> _removeToken() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_token');
  }

  // Headers for requests
  Future<Map<String, String>> _getHeaders() async {
    final token = await _getToken();
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      if (token != null) 'Authorization': 'Bearer $token',
    };
  }

  // Generic HTTP request
  Future<dynamic> _makeRequest(
    String method,
    String endpoint, {
    Map<String, dynamic>? body,
  }) async {
    final url = Uri.parse('${ApiConfig.baseUrl}$endpoint');
    final headers = await _getHeaders();
    http.Response response;

    switch (method.toUpperCase()) {
      case 'GET':
        response = await http.get(url, headers: headers);
        break;
      case 'POST':
        response = await http.post(
          url,
          headers: headers,
          body: body != null ? jsonEncode(body) : null,
        );
        break;
      case 'PUT':
        response = await http.put(
          url,
          headers: headers,
          body: body != null ? jsonEncode(body) : null,
        );
        break;
      case 'DELETE':
        response = await http.delete(url, headers: headers);
        break;
      default:
        throw Exception('Unsupported HTTP method');
    }

    if (response.statusCode >= 200 && response.statusCode < 300) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Request failed with status: ${response.statusCode}');
    }
  }

  // Login
  Future<User> login(String email, String password) async {
    try {
      final response = await _makeRequest(
        'POST',
        '/login',
        body: {'email': email, 'password': password},
      );

      final token = response['access_token'];
      await _saveToken(token);

      return User.fromJson(response['user']);
    } catch (e) {
      rethrow;
    }
  }

  // Logout
  Future<void> logout() async {
    try {
      await _makeRequest('POST', '/logout');
      await _removeToken();
    } catch (e) {
      await _removeToken();
      rethrow;
    }
  }

  // Get current user
  Future<User> getCurrentUser() async {
    final response = await _makeRequest('GET', '/user');
    return User.fromJson(response as Map<String, dynamic>);
  }

  // Get all products
  Future<List<Product>> getProducts() async {
    final response = await _makeRequest('GET', '/products');
    if (response is List) {
      return response
          .map((json) => Product.fromJson(json as Map<String, dynamic>))
          .toList();
    } else {
      throw Exception('Unexpected response format for products');
    }
  }

  // Get single product
  Future<Product> getProduct(int id) async {
    final response = await _makeRequest('GET', '/products/$id');
    return Product.fromJson(response as Map<String, dynamic>);
  }

  // Get all orders
  Future<List<Order>> getOrders() async {
    final response = await _makeRequest('GET', '/orders');
    if (response is List) {
      return response
          .map((json) => Order.fromJson(json as Map<String, dynamic>))
          .toList();
    } else {
      throw Exception('Unexpected response format for orders');
    }
  }

  // Get single order
  Future<Order> getOrder(int id) async {
    final response = await _makeRequest('GET', '/orders/$id');
    return Order.fromJson(response as Map<String, dynamic>);
  }
}

