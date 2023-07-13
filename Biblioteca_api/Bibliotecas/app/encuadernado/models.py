from django.db import models

# Create your models here.

class EncuadernadoModel(models.Model):

    id = models.BigIntegerField(db_column='id',primary_key=True)
    encuadernado = models.CharField(db_column='encuadernado',max_length=50)
    estado = models.BooleanField(db_column='estado',default=True)
    fecha = models.DateTimeField(db_column='fecha',auto_now_add=True)

    class Meta:
        managed = True
        db_table = 'encuadernado'
        verbose_name = 'encuadernado'
        verbose_name_plural = 'encuadernados'