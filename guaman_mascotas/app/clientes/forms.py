from django import forms
from django.contrib.auth.models import User

from app.modelos.models import Cliente, Mascota


class UserFormulario(forms.ModelForm):
    class Meta:
        model = User
        fields = ["first_name", "last_name", "email", "password"]
        widgets = {
            'first_name': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Nombres'}),
            'last_name': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Apellidos'}),
            'email': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Correo'}),
            'password': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Contraseña'}),
        }
        """for field in self.fields:
            self.fields[field].widget.attrs.update({'class': 'form-control', 'placeholder': field.capitalize()})"""


class ClienteFormulario(forms.ModelForm):
    class Meta:
        model = Cliente
        fields = ["cedula", "celular", "direccion"]
        widgets = {
            'cedula': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Cédula'}),
            'celular': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Celular'}),
            'direccion': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Dirección'}),
        }
        """for field in self.fields:
            self.fields[field].widget.attrs.update({'class': 'form-control', 'placeholder': field.capitalize()})"""


class MascotaFormulario(forms.ModelForm):
    class Meta:
        model = Mascota
        fields = ["nombre", "raza", "altura", "tipo"]
        widgets = {
            'nombre': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Nombre'}),
            'raza': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Raza'}),
            'altura': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Altura'}),
            'tipo': forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Tipo'}),
        }
        """for field in self.fields:
            self.fields[field].widget.attrs.update({'class': 'form-control', 'placeholder': field.capitalize()})"""


class FormularioLogin(forms.Form):
    email = forms.CharField(
        widget=forms.TextInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Email'}))
    password = forms.CharField(
        widget=forms.PasswordInput(attrs={'class': 'form-control form-control-user', 'placeholder': 'Contraseña'}))
