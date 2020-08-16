from pprint import pprint

from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.models import User, Group
from django.http import HttpResponseRedirect
from django.shortcuts import render, redirect

# Create your views here.
from django.urls import reverse

from app.clientes.forms import FormularioLogin, ClienteFormulario, UserFormulario, MascotaFormulario
from app.helpers.helpers import *
from app.login.views import *

from app.modelos.models import Cliente, Mascota, Turno


def index(request):
    user = request.user
    if not is_veterinario(user):
        return redirect(ingresar)
    turnos = Turno.objects.all().filter(estado = 'En Espera')
    return render(request, 'index_veterinario.html', locals())



