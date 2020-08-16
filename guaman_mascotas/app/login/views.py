from pprint import pprint

from django.contrib.auth import authenticate, login, logout
from django.shortcuts import render, redirect

# Create your views here.
from app.clientes import views as viewCliente
from app.clientes.forms import FormularioLogin
from app.helpers.helpers import is_cliente, is_veterinario
from app.veterinarios import views


def ingresar(request):
    if is_cliente(request.user):
        return redirect(viewCliente.index)
    if is_veterinario(request.user):
        return redirect(views.index)
    if request.method == 'POST':
        formulario = FormularioLogin(request.POST)
        if formulario.is_valid():
            email = request.POST['email']
            clave = request.POST['password']
            user = authenticate(username=email, password=clave)
            if user is not None:
                if user.is_active and is_cliente(user):
                    login(request, user)
                    # obtener todos los grupos
                    return redirect(viewCliente.index)
                else:
                    if user.is_active and is_veterinario(user):
                        login(request, user)
                        # obtener todos los grupos
                        return redirect(views.index)
                    else:
                        pprint("No es cliente")
    else:
        formulario = FormularioLogin()
        context = {
            'formulario': formulario
        }
    return render(request, 'login.html', locals())


def salir(request):
    if is_cliente(request.user) or is_veterinario(request.user):
        logout(request)
    return redirect(ingresar)
