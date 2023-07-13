from rest_framework import serializers
from .models import LibroModel
from app.autor.models import AutorModel
from app.categoria.models import CategoriaModel
from app.editorial.models import EditorialModel
from app.encuadernado.models import EncuadernadoModel
from app.autor.serializer import AutorSerializer
from app.categoria.serializer import CategoriaSerializer
from app.editorial.serializer import EditorialSerializer
from app.encuadernado.serializer import EncuadernadoSerializer

class LibroSerializer(serializers.HyperlinkedModelSerializer):
    autor_id = serializers.PrimaryKeyRelatedField(queryset=AutorModel.objects.all())
    autor = serializers.CharField(source='autor.autor',read_only=True)
    categoria_id = serializers.PrimaryKeyRelatedField(queryset=CategoriaModel.objects.all())
    categoria = serializers.CharField(source='categoria.categoria',read_only=True)
    editorial_id = serializers.PrimaryKeyRelatedField(queryset=EditorialModel.objects.all())
    editorial = serializers.CharField(source='editorial.editorial',read_only=True)
    encuadernado_id = serializers.PrimaryKeyRelatedField(queryset=EncuadernadoModel.objects.all())
    encuadernado = serializers.CharField(source='encuadernado.encuadernado',read_only=True)

    class Meta:
        model = LibroModel
        fields = ['id','img','titulo','autor_id','autor','categoria_id','categoria','editorial_id','editorial','encuadernado_id','encuadernado','ejemplares','estado','fecha']
    
class LibroUpdateSerializer(serializers.HyperlinkedModelSerializer):
    autor_id = serializers.PrimaryKeyRelatedField(queryset=AutorModel.objects.all())
    autor = AutorSerializer(read_only=True)
    categoria_id = serializers.PrimaryKeyRelatedField(queryset=CategoriaModel.objects.all())
    categoria = CategoriaSerializer(read_only=True)
    editorial_id = serializers.PrimaryKeyRelatedField(queryset=EditorialModel.objects.all())
    editorial = EditorialSerializer(read_only=True)
    encuadernado_id = serializers.PrimaryKeyRelatedField(queryset=EncuadernadoModel.objects.all())
    encuadernado = EncuadernadoSerializer(read_only=True)

    class Meta:
        model = LibroModel
        fields = ['id','img','titulo','autor_id','autor','categoria_id','categoria','editorial_id','editorial','encuadernado_id','encuadernado','ejemplares']