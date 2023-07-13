from django.shortcuts import render
from rest_framework import viewsets
from rest_framework.permissions import IsAuthenticated
from .models import EditorialModel
from .serializer import EditorialSerializer, EditorialUpdateSerializer
from rest_framework.response import Response
from rest_framework.decorators import action

# Create your views here.

class EditorialViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = EditorialModel.objects.all()
    serializer_class = EditorialSerializer
    model = EditorialModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            editorial = list(EditorialModel.objects.filter().values())
            if len(editorial) > 0:
                message = {'message':'Editoriales listados','data':editorial}
            else:
                message = {'message':'Editoriales no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def post(self,request):
        try:
            serializer = EditorialSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                serializer.save()
                message = {'message':'Editorial creado','data':serializer.data}
            else:
                message = {'message':'Editorial no creado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
    
    def put(self,request,**kwargs):
        try:
            editorial = EditorialModel.objects.filter(id=kwargs['pk']).first()
            if editorial:
                serializer = EditorialUpdateSerializer(editorial,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    serializer.save()
                    message = {'message':'Editorial actualizado','data':serializer.data}
                else:
                    message = {'message':'Editorial no actualizado'}
            else:
                message = {'message':'Editorial no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    @action(detail=False,methods=['delete'] , url_path='editorial/(?P<pk>[0-9]+)/')
    def delete(self,request,**kwargs):
        try:
            editorial = list(EditorialModel.objects.filter(id=kwargs['pk']).values())
            if len(editorial) > 0:
                editorial = EditorialModel.objects.get(id=kwargs['pk'])
                if editorial.estado == False:
                    editorial.estado = True
                    editorial.save()
                    datos = {'message':'Editorial restaurado'}
                elif editorial.estado == True:
                    editorial.estado = False
                    editorial.save()
                    datos = {'message':'Editorial eliminado'}
            else:
                datos = {'message':'Editorial no encontrado'}
            return Response(datos)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)