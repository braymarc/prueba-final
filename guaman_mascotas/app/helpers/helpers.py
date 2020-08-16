from pprint import pprint

from app.modelos.models import Cliente

def verifyGroup(user, name):
    return user.is_authenticated and user.groups.filter(name=name).exists()


def is_veterinario(user):
    return verifyGroup(user, 'veterinarios')


def is_cliente(user):
    return verifyGroup(user, 'usuarios')

def getCliente(user):
    cliente = Cliente.objects.all().filter(user_id=user.id)[0]
    return cliente
