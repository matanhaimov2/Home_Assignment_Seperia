# using a lightweight and stable Python version
FROM python:3.11-slim

# environment settings to prevent creation of pyc files and ensure immediate logs
ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1

# define the working directory inside the container
WORKDIR /app

# install the libraries
COPY requirements.txt /app/
RUN pip install --no-cache-dir -r requirements.txt

# copy the entire project
COPY . /app/

# expose the Django port
EXPOSE 8000

# run the server
CMD ["python", "manage.py", "runserver", "0.0.0.0:8000"]