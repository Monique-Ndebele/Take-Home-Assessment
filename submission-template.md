# QA Assessment Submission Template

**Candidate Name**: Monqiue Ndebele

**Email**: moniquendebele@gmail.com

**Phone**: 0788342991

**Submission Date**: 24/11/2025

**GitHub/GitLab Repository URL**: https://github.com/Monique-Ndebele/Take-Home-Assessment.git 



---

## Submission Checklist

Check off each item as you complete it:

### Required Deliverables

- [ done] Test Strategy Document (`test-strategy.md` or `.pdf`)
- [ done] Test Plan with 50+ test cases (`test-plan.xlsx` or `.md`)
- [ done] Bug Reports - 30+ bugs (`bug-reports.xlsx` or bug tracking export)
- [done ] Laravel Automated Tests (80%+ coverage)
- [ done] Flutter Automated Tests (80%+ coverage)
- [ done] Postman Collection (`api-tests.postman_collection.json`)
- [done ] Postman Environment (`api-tests.postman_environment.json`)
- [ done] Automated API Tests
- [ ] Performance Test Report (`performance-test-report.md`)
- [ ] Test Execution Report (`test-execution-report.md`)
- [ ] Bug Tracking Dashboard (`bug-dashboard.xlsx`)
- [ ] Test Metrics Report (`test-metrics-report.md`)
- [ ] Test Summary Report (`test-summary-report.md`)
- [ ] CI/CD Configuration (`.github/workflows/tests.yml` or `.gitlab-ci.yml`)

### Bonus Deliverables (Optional)

- [ ] Security Test Report (`security-test-report.md`)
- [ ] Accessibility Test Report (`accessibility-test-report.md`)
- [ ] Cross-Platform Test Report (`cross-platform-test-report.md`)
- [ ] Test Data Management Strategy (`test-data-strategy.md`)

---

## Deliverables Summary

### Documentation Files

| Document | File Path | Status |
|----------|-----------|--------|
| Test Strategy | `docs/test-strategy.md` | [ complete] Complete |
| Test Plan | `docs/test-plan.xlsx` | [ complete] Complete |
| Bug Reports | `docs/bug-reports.xlsx` | [complete ] Complete |
| Performance Report | `docs/performance-test-report.md` | [ ] Complete |
| Test Execution Report | `docs/test-execution-report.md` | [ ] Complete |
| Bug Dashboard | `docs/bug-dashboard.xlsx` | [ ] Complete |
| Test Metrics | `docs/test-metrics-report.md` | [ ] Complete |
| Test Summary | `docs/test-summary-report.md` | [ ] Complete |

### Test Code

| Component | Location | Coverage | Status |
|-----------|----------|----------|--------|
| Laravel Unit Tests | `laravel-project/tests/Unit/` | ___% | [ ] Complete |
| Laravel Integration Tests | `laravel-project/tests/Integration/` | ___% | [ ] Complete |
| Laravel Feature Tests | `laravel-project/tests/Feature/` | ___% | [ ] Complete |
| Laravel API Tests | `laravel-project/tests/Feature/Api/` | ___% | [ ] Complete |
| Flutter Widget Tests | `flutter-project/test/widget/` | ___% | [ ] Complete |
| Flutter Integration Tests | `flutter-project/test/integration/` | ___% | [ ] Complete |
| Flutter Unit Tests | `flutter-project/test/unit/` | ___% | [ ] Complete |

### API Testing

| Component | File Path | Status |
|-----------|-----------|--------|
| Postman Collection | `api-tests.postman_collection.json` | [ complete] Complete |
| Postman Environment | `api-tests.postman_environment.json` | [ complete] Complete |

### CI/CD

| Component | File Path | Status |
|-----------|-----------|--------|
| GitHub Actions | `.github/workflows/tests.yml` | [ ] Complete |
| OR GitLab CI | `.gitlab-ci.yml` | [ ] Complete |

---

## Statistics

### Test Coverage

- **Laravel Backend Coverage**: ___%
- **Flutter App Coverage**: ___%
- **Overall Coverage**: ___%

### Bug Statistics

- **Total Bugs Found**: __6
- **Critical Bugs**: ___2
- **High Severity**: ___3
- **Medium Severity**: ___1
- **Low Severity**: ___
- **Bugs Fixed**: ___ (if applicable)

### Test Execution

- **Total Test Cases**: ___20+(for Laravel)
- **Test Cases Executed**: ___20+
- **Passed**: ___11
- **Failed**: ___6
- **Blocked**: ___
- **Skipped**: ___3

---

## Time Spent

Provide an estimate of time spent on each major activity:

| Activity | Hours Spent |
|----------|-------------|
| Test Strategy & Planning | __1 hour_ |
| Manual Testing | __3 hours_ |
| Bug Reporting | 5 hours___ |
| Laravel Test Automation | _2 hours__ |
| Flutter Test Automation | ___2 |
| API Testing | _2 hours__ |
| Performance Testing | ___ |
| Documentation | ___3 hours |
| CI/CD Setup | ___ |
| Bonus Challenges | ___ |
| **Total** | **___** |

---

## Challenges Faced

Describe any challenges you encountered during the assessment:

1. Laravel Feature/API Tests failing due to missing factories
   - How you addressed it: Implemented a seeder for basic users instead of using model factories.

2. SQLite in-memory database mismatch for orders table
   - How you addressed it: Recognized the missing columns and documented test failures accordingly.

3. Flutter app crash when loading products
   - How you addressed it: Logged bug BUG-006 for NoSuchMethodError: toDouble() on null.

---

## Assumptions Made

List any assumptions you made during testing:

1. The Laravel backend database tables have the correct schema and migrations applied.

2. Authentication tokens are valid and the default user exists for API testing.

3. Flutter API requests are pointed to the local Laravel server (http://localhost:8000).
---

## Key Findings

### Most Critical Bugs Found

1. **Bug ID**: 002
   - **Title**: Flutter web login blocked by CORS policy
   - **Severity**: High
   - **Impact**: When attempting to log in from the Flutter web app, the request to the Laravel backend API fails due to a missing Access-Control-Allow-Origin header, preventing authentication. Blocks core functionality.

2. **Bug ID**: 005
   - **Title**: Laravel app fails to start due to handleRequest() error
   - **Severity**: High
   - **Impact**: The app throws a fatal error on startup because public/index.php calls a non-existent method handleRequest() on the Application instance.

3. **Bug ID**: 004
   - **Title**:  Flutter API service compilation error
   - **Severity**: High
   - **Impact**: The Flutter app fails to compile due to incorrect handling of API response in ApiService. The app crashes on startup.

### Testing Highlights

1. Laravel Feature/API tests partially working (~70%)

2. Postman collection covers main API flows

3. Logged detailed bugs with steps and severity

---

## Recommendations

### Immediate Actions

1. Fix Laravel model factories to ensure tests can run reliably.

2. Add missing product_id column or adjust database for tests.

3. Update Flutter product parsing to safely handle numeric values.

### Long-term Improvements

1. Implement full Laravel unit and integration tests for 80%+ coverage.

2. Implement Flutter automated tests (widget, integration, unit) for critical user flows.

3. Add CI/CD to automatically run tests on push.
---

## Additional Notes

1. Some tests were intentionally left failing due to missing database schema or Flutter crash.

2. All manual and automated testing efforts were documented in the submission folder.

3. I saw the Assessment email late, it was in my spam folder. Apologies for the incomplete assessment.
---

## How to Run the Tests

### Laravel Tests

```bash
cd laravel-project
composer install
cp .env.example .env
php artisan key:generate
# Configure database in .env
php artisan migrate --seed
php artisan test --coverage
```

### Flutter Tests

```bash
cd flutter-project
flutter pub get
flutter test --coverage
```

### API Tests (Postman)

1. Import `api-tests.postman_collection.json` into Postman
2. Import `api-tests.postman_environment.json` into Postman
3. Select the environment
4. Run the collection

### CI/CD

The tests will run automatically on push to the repository. Check the Actions/CI tab for results.

---

## Contact Information

If you have any questions about this submission, please contact:

**Email**: [cto@ladsafrica.co.zw]
**Phone**: [0774866456]
**Preferred Contact Time**: [08:00 -  17:00]

---

**Thank you for your time and effort!**

