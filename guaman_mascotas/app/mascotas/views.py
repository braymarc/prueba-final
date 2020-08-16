from pprint import pprint

from django.shortcuts import render, redirect

# Create your views here.
from app.clientes import views
from app.clientes.forms import MascotaFormulario
from app.helpers.helpers import is_cliente, getCliente
from app.modelos.models import Mascota


def crear(request):
    user = request.user
    formulario_mascota = MascotaFormulario(request.POST)
    if not is_cliente(user):
        return redirect(views.ingresar)
    if request.method == 'POST':
        if formulario_mascota.is_valid():
            datos_mascota = formulario_mascota.cleaned_data
            mascota = Mascota()
            cliente = getCliente(user)
            mascota.cliente = cliente
            mascota.nombre = datos_mascota.get('nombre')
            mascota.raza = datos_mascota.get('raza')
            mascota.altura = datos_mascota.get('altura')
            mascota.tipo = datos_mascota.get('tipo')
            mascota.save()
        else:
            pprint('Error al cargar form')
    return redirect(views.index)