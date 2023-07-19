from django.shortcuts import render
from rest_framework import viewsets
from rest_framework.response import Response
from rest_framework.authtoken.models import Token
from .serializer import UsuarioSerializer,UsuarioUpdateSerializer
from .models import UsuarioModel
from rest_framework.permissions import IsAuthenticated
from rest_framework.authtoken.views import ObtainAuthToken
from rest_framework.decorators import action

# Create your views here.

class UsuarioEmpleadoCountViewSet(viewsets.ReadOnlyModelViewSet):
    
    queryset = UsuarioModel.objects.filter(cargo=3,estado=True)
    serializer_class = UsuarioSerializer
    model = UsuarioModel
    permission_classes = [IsAuthenticated]

    def list(self,request, *args, **kwargs):
        try:
            cant = self.queryset.count()
            message = {'message':'Usuarios contados', 'data':cant}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class UsuarioEmpleadoViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = UsuarioModel.objects.all()        
    serializer_class = UsuarioSerializer
    model = UsuarioModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            usuario = list(UsuarioModel.objects.filter(cargo=3,estado=True).values())
            if len(usuario) > 0:
                responseData = {'message':'Usuarios listados','data': usuario}
            else:
                responseData = {'message':'Usuarios no listados'}
            return Response(responseData)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class UsuarioViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = UsuarioModel.objects.all()        
    serializer_class = UsuarioSerializer
    model = UsuarioModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            usuario = list(UsuarioModel.objects.filter().values())
            if len(usuario) > 0:
                responseData = {'message':'Usuarios listados','data': usuario}
            else:
                responseData = {'message':'Usuarios no listados'}
            return Response(responseData)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

    def post(self,request,format=None):
        try:
            serializer = UsuarioSerializer(data = request.data, context={'request': request})
            if serializer.is_valid():
                serializer.save()
                message = {'message':'Usuario creado','data':serializer.data}
            else:
                message = {'message':'Usuario no creado'}
            return Response(message)  
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)  
    
    def put(self,request,**kwargs):
        try:
            usuario = UsuarioModel.objects.filter(documento=kwargs['pk']).first()
            if usuario:
                serializer = UsuarioUpdateSerializer(usuario, data = request.data, context={'request': request},partial=False)
                if serializer.is_valid():
                    serializer.save()
                    datos = {'message':'Usuario actualizado','data':serializer.data}
                else:
                    datos = {'message':'Usuario no actualizado'}
            else:
                datos = {'message':'Usuario no encontrado'}
            return Response(datos)
        except Exception as ex:
            responseData = 'excep ' +str(ex)
            return Response(responseData)
        
    @action(detail=False,methods=['delete'] , url_path='usuario/(?P<pk>[0-9]+)/')
    def delete(self, request, **kwargs):
        try:
            usuario = list(UsuarioModel.objects.filter(documento=kwargs['pk']).values())
            if len(usuario) > 0:
                usuario = UsuarioModel.objects.get(documento=kwargs['pk'])
                if usuario.estado == False:
                    usuario.estado = True
                    usuario.save()
                    datos = {'message':'Usuario restaurado'}
                elif usuario.estado == True:
                    usuario.estado = False
                    usuario.save()
                    datos = {'message':'Usuario eliminado'}
            else:
                datos = {'message':'Usuario no encontrado'}
            return Response(datos)
        except Exception as ex:
            responseData = 'excep ' +str(ex)
            return Response(responseData)

class LoginViewSet(ObtainAuthToken):

    def post(self,request,**kwargs):
        try:
            serializer = self.serializer_class(data=request.data,context={'request': request})
            if serializer.is_valid():
                user = serializer.validated_data['user']
                token, created = Token.objects.get_or_create(user=user)
                if serializer.is_valid():
                    responseData = {'Mensaje':'Usuario encontrado',
                                    'Datos': { 'token': token.key , 'user_id' : user.pk, 'user_name': user.nombre+' '+user.apellido , 'estado': user.estado , 'cargo': user.cargo}}
                else:
                    responseData = 'Usuario invalido/contraseña incorrecta'
                return Response(responseData)
            else:
                responseData = "Usuario no encontrado",serializer.errors
                return Response(responseData, status=200)
        except Exception as ex:
            responseData = 'excep ' +str(ex)
            return Response(responseData)