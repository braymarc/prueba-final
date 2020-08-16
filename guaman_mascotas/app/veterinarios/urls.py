
from django.contrib import admin
from django.urls import path, include

from app.veterinarios import views

urlpatterns = [
    path('', views.index, name='veterinario_index'),
]
