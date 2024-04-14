# Booking Auth Service
Authentication Microservice to Manage User Tokens, Access, Permission


### How to Start service locally

1. If start a service first time then run following ``make`` command
   ``make install_and_start``
2. Run a following ``make`` command
``make start``
3. In order to pre-populate local DB run the following command
``make db-seed``
4. In order to re-generate OpenApi documentation run the following command
``make api-docs-generate``
5. API documentation could be opened by the following link: ``http://localhost:8701/api/docs``

### How to Stop service locally

1. Run a following ``make`` command
   ``make stop``

### How to run test locally

1. Run a following ``make`` command
   ``make tests-setup``
2. Run a following ``make`` command
   ``make tests``