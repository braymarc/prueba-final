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
    formulario_mascota = MascotaFormulario(request.POST)
    if not is_cliente(user):
        return redirect(ingresar)
    cliente = getCliente(user)
    mascotas = Mascota.objects.all().filter(cliente = cliente)

    turnos = []
    for mascota in mascotas:
        turnoMascota = Turno.objects.all().filter(mascota = mascota)
        if len(turnoMascota)>0:
            turnos +=turnoMascota
    return render(request, 'index.html', locals())






def registro(request):
    if is_cliente(request.user):
        return redirect(index)
    formulario_cliente = ClienteFormulario(request.POST)
    formulario_usuario = UserFormulario(request.POST)
    if request.method == 'POST':
        if formulario_cliente.is_valid() and formulario_usuario.is_valid():
            cliente = Cliente()
            datos_usuario = formulario_usuario.cleaned_data
            datos_cliente = formulario_cliente.cleaned_data
            user = User.objects.create_user(
                username=datos_usuario.get('email'),
                email=datos_usuario.get('email'),
                password=datos_usuario.get('password'),
                first_name=datos_usuario.get('first_name'),
                last_name=datos_usuario.get('last_name'),
            )
            # agregamos el usuario a un grupo
            my_group = Group.objects.get(name='usuarios')
            my_group.user_set.add(user)

            cliente.cedula = datos_cliente.get('cedula')
            cliente.celular = datos_cliente.get('celular')
            cliente.direccion = datos_cliente.get('direccion')
            cliente.user = user
            cliente.save()

        else:
            pprint('Formulario inválido')
        return redirect(index)

    return render(request, 'register.html', locals())


def salirSistema(request):
    logout(request)
    return HttpResponseRedirect(reverse('clientes'))
