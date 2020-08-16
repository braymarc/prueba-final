from django.shortcuts import render, redirect

# Create your views here.
from app.clientes import views
from app.helpers.helpers import is_cliente
from app.modelos.models import Turno, Mascota


def crear(request):
    user = request.user
    if not is_cliente(user):
        return redirect(views.ingresar)
    if request.method == 'POST':
        mascotaId = request.POST['mascotaId']
        mascota = Mascota.objects.all().filter(mascota_id=mascotaId)
        if len(mascota) > 0:
            mascota = mascota[0]
            turno = Turno()
            turno.mascota = mascota
            turno.save()

    return redirect(views.index)
