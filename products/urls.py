from django.urls import path
from .views import product_list, api_products_list

urlpatterns = [
    path('', product_list, name='product_list'),
    path('api/', api_products_list, name='api_products_list'),
]