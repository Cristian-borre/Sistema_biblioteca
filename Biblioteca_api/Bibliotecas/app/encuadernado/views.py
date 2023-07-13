from django.shortcuts import render
from rest_framework import viewsets
from rest_framework.permissions import IsAuthenticated
from .models import EncuadernadoModel
from .serializer import EncuadernadoSerializer, EncuadernadoUpdateSerializer
from rest_framework.response import Response
from rest_framework.decorators import action

# Create your views here.

class EncuadernadoViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = EncuadernadoModel.objects.all()
    serializer_class = EncuadernadoSerializer
    model = EncuadernadoModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            encuadernado = list(EncuadernadoModel.objects.filter().values())
            if len(encuadernado) > 0:
                message = {'message':'Encuadernados listados','data':encuadernado}
            else:
                message = {'message':'Encuadernados no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def post(self,request):
        try:
            serializer = EncuadernadoSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                serializer.save()
                message = {'message':'Encuadernado creado','data':serializer.data}
            else:
                message = {'message':'Encuadernado no creado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def put(self,request,**kwargs):
        try:
            encuadernado = EncuadernadoModel.objects.filter(id=kwargs['pk']).first()
            if encuadernado:
                serializer = EncuadernadoUpdateSerializer(encuadernado,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    serializer.save()
                    message = {'message':'Encuadernado actualizado','data':serializer.data}
                else:
                    message = {'message':'Encuadernado no actualizado'}
            else:
                message = {'message':'Encuadernado no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

    @action(detail=False,methods=['delete'],url_path='encuadernado/(?P<pk>[0-9]+)/')    
    def delete(self,request,**kwargs):
        try:
            encuadernado = list(EncuadernadoModel.objects.filter(id=kwargs['pk']).values())
            if len(encuadernado) > 0:
                encuadernado = EncuadernadoModel.objects.get(id=kwargs['pk'])
                if encuadernado.estado == False:
                    encuadernado.estado = True
                    encuadernado.save()
                    message = {'message':'Encuadernado restaurado'}
                elif encuadernado.estado == True:
                    encuadernado.estado = False
                    encuadernado.save()
                    message = {'message':'Encuadernado eliminado'}
            else:
                message = {'message':'Encuadernado no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)