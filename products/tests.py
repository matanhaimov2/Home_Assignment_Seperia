from django.test import TestCase
from .services import DummyJsonService

class ProductServiceTest(TestCase):
    """
    Tests for the DummyJsonService logic
    """
    def test_get_products_structure(self):
        # check if the service returns the correct structure with Pydantic
        response = DummyJsonService.get_products(page=1)
        self.assertEqual(len(response.products), 10) # we request 10 products per page
        self.assertTrue(hasattr(response, 'total'))

    def test_search_logic(self):
        # check if the specific search returns relevant results
        query = "iPhone"
        response = DummyJsonService.get_products(search_query=query)
        # check if at least one of the products contains the word we searched for
        titles = [p.title.lower() for p in response.products]
        self.assertTrue(any(query.lower() in t for t in titles))