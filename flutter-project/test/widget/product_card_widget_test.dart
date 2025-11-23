import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:qa_assessment_app/widgets/product_card.dart';
import 'package:qa_assessment_app/models/product.dart';

void main() {
  testWidgets('ProductCard displays name and price', (WidgetTester tester) async {
    final product = Product(
  id: 1,
  name: "Milk",
  price: 4.50,
  stock: 10,
);


    await tester.pumpWidget(
      MaterialApp(
        home: Scaffold(
          body: ProductCard(
  product: product,
  onTap: () {},
),

        ),
      ),
    );

    expect(find.text('Milk'), findsOneWidget);
    expect(find.text('\$4.50'), findsOneWidget);
  });
}
