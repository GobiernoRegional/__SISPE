-- Function: fn_insertarpersonal(character varying, character varying, character, date, character, character varying, character, character, character, character varying, character varying, character)

-- DROP FUNCTION fn_insertarpersonal(character varying, character varying, character, date, character, character varying, character, character, character, character varying, character varying, character);

CREATE OR REPLACE FUNCTION fn_insertarpersonal(apellidos character varying, nombres character varying, dni character, fnac date, codarea character, direccion character varying, sexo character, codcargo character, correo character varying, telefono character varying, estado character,usuario character varying, pass character varying)
  RETURNS void AS
$BODY$
   declare
  codigo character(10);
  cantidad integer;  
   begin
  select count(*) into Cantidad from tbpersonal;   

  IF Cantidad = 0 then
  Codigo = 'PER0000001';

  ELSE
  select max(per_codigo) into Codigo from tbpersonal;

  Codigo = 'PER' || Right('0000000'|| Cast(right(Codigo,7) as int) + 1,7);
  END IF;

  insert into tbpersonal(per_codigo,per_apellido,per_nombre,per_dni,Per_fnac,
     per_are_codigo, per_direccion, per_sexo, per_car_codigo, per_correo, per_telefono,per_estado,usuario,pass)
  values(Codigo,apellidos,nombres,dni,fnac, codarea,direccion,sexo, codcargo,correo,telefono,estado,usuario,pass);
   end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
