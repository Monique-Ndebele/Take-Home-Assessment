import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:integration_test/integration_test.dart';
import 'package:qa_assessment_app/main.dart' as app;

void main() {
  IntegrationTestWidgetsFlutterBinding.ensureInitialized();

  testWidgets("User can log in and load products", (WidgetTester tester) async {
    app.main();
    await tester.pumpAndSettle();

    // Enter email
    await tester.enterText(find.byKey(Key('emailField')), 'test@example.com');

    // Enter password
    await tester.enterText(find.byKey(Key('passwordField')), 'password');

    // Tap login
    await tester.tap(find.byKey(Key('loginButton')));
    await tester.pumpAndSettle();

    // Expect products screen to load
    expect(find.text("Products"), findsOneWidget);
  });
}
