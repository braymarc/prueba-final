
from django.contrib import admin
from django.urls import path, include

from app.login import views

urlpatterns = [
    path('', views.ingresar, name='login'),
    path('salir/', views.salir, name='salir'),
]
