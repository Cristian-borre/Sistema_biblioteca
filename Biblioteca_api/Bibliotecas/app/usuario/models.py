from django.db import models
from django.contrib.auth.models import AbstractUser

# Create your models here.

CARGO_CHOISE = (
    (1,'admin'),
    (2,'empleado'),
    (3,'natural'),
)

class UsuarioModel(AbstractUser):

    documento = models.BigIntegerField(db_column='documento', primary_key=True)
    nombre = models.CharField(db_column='nombre',max_length=50)
    apellido = models.CharField(db_column='apellido',max_length=50)
    email = models.CharField(db_column='email',max_length=70, unique=True)
    telefono = models.BigIntegerField(db_column='telefono')
    password = models.CharField(db_column='password',max_length=200)
    cargo = models.IntegerField(choices=CARGO_CHOISE, db_column='cargo')
    estado = models.BooleanField(db_column='estado', default=True)
    fecha = models.DateTimeField(db_column='fecha', auto_now_add=True)
    username = None

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = []

    class Meta:
        managed = True
        db_table = 'usuario'
        verbose_name = 'usuario'
        verbose_name_plural = 'usuarios'