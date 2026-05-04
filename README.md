# Product Directory Project (Django)

A professional product management dashboard built with Django, integrating with the DummyJSON API.

## 🚀 Key Features
- **Dynamic Table**: Fetching and displaying product data.
- **Server-Side Pagination & Search**: Optimized data fetching.
- **Interactive Gallery**: JavaScript-powered gallery with loading states and skeletons.
- **Data Integrity**: Using **Pydantic** for schema validation of external API responses.
- **Containerized**: Fully Dockerized for easy deployment.

## 🛠 Tech Stack
- **Backend**: Django (Python)
- **Validation**: Pydantic
- **Frontend**: Tailwind CSS & Vanilla JS
- **DevOps**: Docker & Docker Compose
- **Testing**: Django TestCase
- **CMS & Integration**: WordPress (PHP)
- **Database**: MySQL (for WordPress)

## 📦 Installation & Setup
Run the project instantly using Docker:
```bash
docker-compose up --build
```

### Accessing the Services:
- **Django App (Dashboard)**: http://localhost:8000/products
- **WordPress Site (Bonus Integration)**: http://localhost:8080

**Note for Bonus View**: To see the Django products inside WordPress, log in to the admin panel at http://localhost:8080/wp-admin, ensure the "Django Products Connector" plugin is activated, and create a new page with the shortcode [show_my_products].

## 🧪 Running Tests
To execute the unit tests (no DB connection required):
```bash
python manage.py test
```
## 🌟 Bonus: WordPress Microservice Integration
I have integrated a WordPress instance as a separate microservice that consumes the Django API.

**Implementation Details:**

- **Custom WordPress Plugin**: A dedicated PHP plugin (my_django_connector) that fetches data from the Django Backend.

- **Internal Docker Networking**: Communication is handled via the internal Docker network using service names (e.g., http://web:8000), demonstrating an understanding of container orchestration.

- **Dynamic Rendering**: Using a custom WordPress Shortcode [show_my_products] to display a responsive product gallery directly within a WordPress page.

## 🧠 Technical Decisions

- **Pydantic**: Chosen to ensure the external API data matches our internal expectations and to handle missing fields gracefully.

- **Vanilla JS & json_script**: Used for the gallery to keep the frontend lightweight while safely passing data from Python to JS.

- **Docker Communication & Security**: Configured Django's ALLOWED_HOSTS to permit internal requests from the WordPress container, ensuring secure yet functional cross-service communication.

**Note**: Ensure your local ports **8000** and **8080** are not occupied by other services before running the Docker containers.