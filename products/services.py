import requests
from .schemas import ProductResponseSchema
from requests.exceptions import RequestException

class DummyJsonService:
    BASE_URL = "https://dummyjson.com/products"

    @classmethod
    def get_products(cls, page: int = 1, search_query: str = None, limit: int = 10):
        # calculate the skip for the API
        skip = (page - 1) * limit
        
        # if there is a search, we use the search endpoint
        if search_query:
            url = f"{cls.BASE_URL}/search"
            params = {"q": search_query, "limit": limit, "skip": skip}
        else:
            url = cls.BASE_URL
            params = {"limit": limit, "skip": skip}

        try:
            response = requests.get(url, params=params, timeout=10)
            response.raise_for_status()

            # validation of the data
            return ProductResponseSchema(**response.json())
        except (RequestException, ValueError) as e:
            print(f"API Error: {e}") 
            return None