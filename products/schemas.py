from pydantic import BaseModel
from typing import List, Optional

class ProductSchema(BaseModel):
    id: int
    title: str
    description: str
    price: float
    rating: float
    stock: int
    # Making these fields optional because they might be missing in some API responses
    brand: Optional[str] = "N/A" 
    category: Optional[str] = "General"
    thumbnail: str
    images: List[str]

class ProductResponseSchema(BaseModel):
    products: List[ProductSchema]
    total: int
    skip: int
    limit: int