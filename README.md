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

## 📦 Installation & Setup
Run the project instantly using Docker:
```bash
docker-compose up --build
```
The app will be available at http://localhost:8000/products.

## 🧪 Running Tests
To execute the unit tests (no DB connection required):
```bash
python manage.py test
```

## 🧠 Technical Decisions

- Pydantic: Chosen to ensure the external API data matches our internal expectations and to handle missing fields gracefully.

- Vanilla JS & json_script: Used for the gallery to keep the frontend lightweight while safely passing data from Python to JS.

**Note**: Ensure your local port **8000** is not occupied by other services (like a local Django server) before running the Docker container.