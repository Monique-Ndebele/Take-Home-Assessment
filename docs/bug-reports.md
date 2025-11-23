BUGS REPORT
Bug ID: BUG-001
•	Title: Flutter app takes too long to load
•	Description: The Flutter mobile app takes an unusually long time to open after launching, affecting user experience.
•	Steps to Reproduce:
1.	Launch the Flutter app on Chrome/Android/iOS.
2.	Observe the time taken for the home screen to appear.
•	Expected Behavior: App should load within 2–5 seconds (depending on platform).
•	Actual Behavior: App takes significantly longer ( 60+ seconds).
•	Severity: Medium or High (depends on how critical fast loading is for the app).
•	Priority: P2.
•	Environment: Flutter Web on Chrome, Flutter, OS: Windows
•	Notes: Might be caused by large asset loading, network calls, or unoptimized code.

Bug ID: BUG-002
• Title: Flutter web login blocked by CORS policy
• Description: When attempting to log in from the Flutter web app, the request to the Laravel backend API fails due to a missing Access-Control-Allow-Origin header, preventing authentication.
• Steps to Reproduce:
1.	Run the Laravel backend API on http://localhost:8000.
2.	Launch the Flutter web app on http://localhost:61626.
3.	Enter valid login credentials and click "Login".
• Expected Behavior: Login should succeed and return a valid token, allowing access to the app.
• Actual Behavior: Browser blocks the request with the error: No 'Access-Control-Allow-Origin' header is present on the requested resource. Login fails.
• Severity: High (blocks core functionality).
• Priority: P1.
• Environment: Flutter Web on Chrome, Laravel backend, Windows 10.
• Notes: Only occurs on web platform; mobile app works fine. Likely requires updating Laravel CORS configuration (fruitcake/laravel-cors or middleware) to allow requests from the web app origin.

Bug ID: BUG-003
• Title: Flutter app takes too long to authenticate user
• Description: After entering login credentials, the app takes an unusually long time to verify user details and proceed to the home screen.
• Steps to Reproduce:
1.	Launch the Flutter app.
2.	Enter valid login credentials (user@test.com / password).
3.	Observe the time taken to complete login and navigate to the home screen.
• Expected Behavior: User authentication should complete within 2–5 seconds.
• Actual Behavior: Authentication takes significantly longer (60+ seconds).
• Severity: Medium
• Priority: P2
• Environment: Flutter Web on Chrome, Flutter SDK, OS: Windows
• Notes: May be caused by unoptimized API calls, slow database queries, or network latency.
 

Bug ID: BUG-004
• Title: Flutter API service compilation error
• Description: The Flutter app fails to compile due to incorrect handling of API response in ApiService. The app crashes on startup.
• Steps to Reproduce:
1.	Clone the Flutter project.
2.	Run flutter run -d chrome.
3.	Observe the compilation error in lib/services/api_service.dart.
• Expected Behavior: App should compile and launch successfully.
• Actual Behavior: Compilation fails with type errors in ApiService.
• Severity: High
• Priority: P1
• Environment: Flutter Web on Chrome, Flutter SDK, OS: Windows
• Notes: Fixed by correcting the API response mapping and ensuring proper environment setup.

Bug ID: BUG-005
• Title: Laravel app fails to start due to handleRequest() error
• Description: The app throws a fatal error on startup because public/index.php calls a non-existent method handleRequest() on the Application instance.
• Steps to Reproduce:
1. Start the Laravel server or open the app in a browser.
2. Observe the fatal error message.
• Expected Behavior: The app should start normally and serve requests.
• Actual Behavior: Fatal error: BadMethodCallException: Method Illuminate\Foundation\Application::handleRequest does not exist.
• Severity: High
• Priority: P1
• Environment: Laravel 10.49.1, PHP 8.x, Windows
• Notes: Fixed by replacing handleRequest() with the correct Laravel request handling code using the HTTP Kernel.

Bug ID: BUG-006
• Title: Flutter app fails to load products due to toDouble() error
• Description: The app throws a NoSuchMethodError when parsing the product price from the API response. The error occurs because .toDouble() is called on a value that is already a double or null.
• Steps to Reproduce:
1.	Open the Flutter app.
2.	Login with valid credentials (user@test.com / password).
3.	Navigate to the product listing screen.
4.	Observe the error message and console log.
• Expected Behavior: The product list should load correctly, displaying all products with their details.
• Actual Behavior: The app fails to load products. Console shows:
NoSuchMethodError: 'toDouble' called on null or invalid type
Receiver: 44.20
Arguments: none
• Severity: Medium
• Priority: P2
• Environment: Flutter, Dart, Chrome, Laravel API backend (http://localhost:8000)
 

