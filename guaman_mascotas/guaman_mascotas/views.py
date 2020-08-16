from django.shortcuts import render, redirect

from app.login import views


def index(request):
    return redirect(views.ingresar)
