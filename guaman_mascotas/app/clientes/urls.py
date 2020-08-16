
from django.contrib import admin
from django.urls import path, include

from app.clientes import views

urlpatterns = [
    path('', views.index, name='cliente_index'),
    path('registro/', views.registro, name='cliente_registro'),
]
