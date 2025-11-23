import 'package:flutter_test/flutter_test.dart';

double? safeToDouble(dynamic value) {
  if (value == null) return null;
  if (value is double) return value;
  if (value is int) return value.toDouble();
  if (value is String) return double.tryParse(value);
  return null;
}

void main() {
  group('safeToDouble', () {
    test('converts integer to double', () {
      expect(safeToDouble(42), 42.0);
    });

    test('converts numeric string to double', () {
      expect(safeToDouble("44.20"), 44.20);
    });

    test('returns null for invalid string', () {
      expect(safeToDouble("abc"), null);
    });

    test('returns null for null input', () {
      expect(safeToDouble(null), null);
    });
  });
}
