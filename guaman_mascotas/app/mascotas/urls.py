
from django.contrib import admin
from django.urls import path, include

from app.turnos import views

urlpatterns = [
    path('crear/', views.crear, name='mascotas_crear')
]
