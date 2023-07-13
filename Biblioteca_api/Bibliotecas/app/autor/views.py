from django.shortcuts import render
from rest_framework import viewsets
from .models import AutorModel
from .serializer import AutorSerializer,AutorUpdateSerializer
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.decorators import action

# Create your views here.

class AutorViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = AutorModel.objects.all()        
    serializer_class = AutorSerializer
    model = AutorModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            autor = list(AutorModel.objects.filter().values())
            if len(autor) > 0:
                message = {'message':'Autores listados','data':autor}
            else:
                message = {'message':'Autores no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData) 
    
    def post(self,request):
        try:
            serializer = AutorSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                serializer.save()
                message = {'message':'Autor creado','data':serializer.data}
            else:
                message = {'message':'Autor no creado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData) 
    
    def put(self,request,**kwargs):
        try:
            autor = AutorModel.objects.filter(id=kwargs['pk']).first()
            if autor:
                serializer = AutorUpdateSerializer(autor,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    serializer.save()
                    message = {'message':'Autor actualizado','data':serializer.data}
                else:
                    message = {'message':'Autor no actualizado'}
            else:
                message = {'message':'Autor no encontrado'}
            return Response(message) 
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData) 
    
    @action(detail=False,methods=['delete'] , url_path='autor/(?P<pk>[0-9]+)/')
    def delete(self, request, **kwargs):
        try:
            autor = list(AutorModel.objects.filter(id=kwargs['pk']).values())
            if len(autor) > 0:
                autor = AutorModel.objects.get(id=kwargs['pk'])
                if autor.estado == False:
                    autor.estado = True
                    autor.save()
                    datos = {'message':'Autor restaurado'}
                elif autor.estado == True:
                    autor.estado = False
                    autor.save()
                    datos = {'message':'Autor eliminado'}
            else:
                datos = {'message':'Autor no encontrado'}
            return Response(datos)
        except Exception as ex:
            responseData = 'excep ' +str(ex)
            return Response(responseData)