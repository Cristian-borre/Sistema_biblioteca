from rest_framework import serializers
from .models import PrestamoModel
from app.libro.models import LibroModel
from app.usuario.models import UsuarioModel
from app.libro.serializer import LibroSerializer
from app.usuario.serializer import UsuarioSerializer

class PrestamoSerializer(serializers.HyperlinkedModelSerializer):
    libro_id = serializers.PrimaryKeyRelatedField(queryset=LibroModel.objects.all())
    libro = serializers.CharField(source='libro.titulo',read_only=True)
    persona_id = serializers.PrimaryKeyRelatedField(queryset=UsuarioModel.objects.all())
    persona = serializers.CharField(source='persona.nombre',read_only=True)

    class Meta:
        model = PrestamoModel
        fields = ['id','libro_id','libro','persona_id','persona','fecha_prestamo','estado_prestamo','fecha']

class PrestamoUpdateSerializer(serializers.HyperlinkedModelSerializer):
    libro_id = serializers.PrimaryKeyRelatedField(queryset=LibroModel.objects.all())
    libro = LibroSerializer(read_only=True)
    persona_id = serializers.PrimaryKeyRelatedField(queryset=UsuarioModel.objects.all())
    persona = UsuarioSerializer(read_only=True)

    class Meta:
        model = PrestamoModel
        fields = ['id','libro_id','libro','persona_id','persona','fecha_prestamo','estado_prestamo']