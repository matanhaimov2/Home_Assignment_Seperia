from django.shortcuts import render
from .services import DummyJsonService
from django.http import JsonResponse

def product_list(request):
    # Get query parameters from the URL
    search_query = request.GET.get('search', '')
    try:
        page = int(request.GET.get('page', 1))
    except ValueError:
        page = 1

    limit = 10
    
    # Fetch data using our service layer
    data = DummyJsonService.get_products(
        page=page, 
        search_query=search_query, 
        limit=limit
    )

    if data is None:
        context = {
            'products': [],
            'total': 0,
            'error_message': "מצטערים, חלה שגיאה במשיכת הנתונים מהשרת. אנא נסו שוב מאוחר יותר.",
            'search_query': search_query,
        }
        return render(request, 'products/list.html', context)

    # Calculate total pages for pagination logic
    total_pages = (data.total + limit - 1) // limit
    
    context = {
        'products': data.products,
        'total': data.total,
        'page': page,
        'search_query': search_query,
        'total_pages': total_pages,
        'has_next': page < total_pages,
        'has_prev': page > 1,
    }
    
    return render(request, 'products/list.html', context)

def api_products_list(request):
    """
    Endpoint that returns the product data in JSON format for the bonus of WordPress
    """
    search_query = request.GET.get('search', '')
    try:
        page = int(request.GET.get('page', 1))
    except ValueError:
        page = 1

    # using the same logic as the Service layer
    data = DummyJsonService.get_products(page=page, search_query=search_query)

    if data is None:
        return JsonResponse({'error': 'Failed to fetch data'}, status=500)

    # converting the Pydantic object to a dictionary and returning it as JSON
    return JsonResponse(data.dict())