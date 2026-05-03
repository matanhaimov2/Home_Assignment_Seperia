from pydantic import BaseModel, HttpUrl
from typing import List

class ProductSchema(BaseModel):
    id: int
    title: str
    description: str
    price: float
    rating: float
    stock: int
    brand: str
    category: str
    thumbnail: str  # we use str for simplicity in Rendering
    images: List[str]

class ProductResponseSchema(BaseModel):
    products: List[ProductSchema]
    total: int
    skip: int
    limit: int