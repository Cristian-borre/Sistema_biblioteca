from django.db import models
from app.libro.models import LibroModel
from app.usuario.models import UsuarioModel

# Create your models here.

ESTADO_CHOISE = (
    (1,'entregado'),
    (2,'pendiente'),
    (3,'reservado'),
)

class PrestamoModel(models.Model):

    id = models.AutoField(primary_key=True)
    libro = models.ForeignKey(LibroModel, db_column='libro', on_delete=models.PROTECT)
    persona = models.ForeignKey(UsuarioModel, db_column='persona', on_delete=models.PROTECT)
    fecha_prestamo = models.DateField(db_column='fecha_prestamo')
    estado_prestamo = models.IntegerField(choices=ESTADO_CHOISE,db_column='estado_prestamo')
    fecha = models.DateTimeField(db_column='fecha',auto_now_add=True)

    class Meta:
        managed = True
        db_table = 'prestamo'
        verbose_name = 'prestamo'
        verbose_name_plural = 'prestamos'