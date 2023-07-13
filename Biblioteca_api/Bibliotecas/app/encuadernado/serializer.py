from rest_framework import serializers
from .models import EncuadernadoModel

class EncuadernadoSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = EncuadernadoModel
        fields = ['id','encuadernado','estado','fecha']

class EncuadernadoUpdateSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = EncuadernadoModel
        fields = ['id','encuadernado']