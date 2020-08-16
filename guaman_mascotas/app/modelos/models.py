from django.contrib.auth.models import User
from django.db import models


class Cliente(models.Model):
    cliente_id = models.AutoField(primary_key=True)
    cedula = models.CharField(max_length=10, null=False, unique=True)
    celular = models.CharField(max_length=15, null=False, default='999999999')
    direccion = models.TextField(max_length=75, null=False, default='Direccion')
    token = models.TextField(max_length=75, null=False, default='')
    user = models.ForeignKey(User, null=True, on_delete=models.CASCADE)

    def __str__(self):
        return self.cedula


class Mascota(models.Model):
    mascota_id = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=10, null=False)
    raza = models.CharField(max_length=70, null=False, default='')
    altura = models.CharField(max_length=70, null=False, default='')
    tipo = models.CharField(max_length=70, null=False, default='')
    cliente = models.ForeignKey(
        'Cliente', on_delete=models.CASCADE
    )
    #user = User.objects.create_user('john', 'lennon@thebeatles.com', 'johnpassword')

    def __str__(self):
        return self.mascota_id


class Turno(models.Model):
    turno_id = models.AutoField(primary_key=True)
    estado = models.CharField(max_length=70, null=False, default='En Espera')
    mascota = models.ForeignKey(
        'Mascota', on_delete=models.CASCADE
    )

    def __str__(self):
        return self.mascota_id

