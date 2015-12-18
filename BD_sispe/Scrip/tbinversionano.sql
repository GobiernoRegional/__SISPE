--Insertar en tabla Inversion_ano
CREATE OR REPLACE FUNCTION fn_inversion_anoinsertar(
    
    ano character,
    monto numeric,
    pin_codigo character,
    total numeric)
    
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbinversion_ano;			
		IF Cantidad = 0 then
		Codigo = 'IAN001';
		ELSE
		select max(ian_codigo) into Codigo from tbinversion_ano;
		Codigo = 'IAN' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;
		insert into tbinversion_ano(ian_codigo,ian_ano,ian_monto,ian_pin_codigo,ian_total)
		values(Codigo,ano,monto,pin_codigo,total);
		end;
  $BODY$
  LANGUAGE plpgsql;
--select * from tbinversion_ano
--select fn_inversion_anoinsertar('2014',3,null,34)
-- Modificar en tabla Inversion_ano
CREATE OR REPLACE FUNCTION fn_inversion_anomodificar(
    codigo character,
    ano character,
    monto numeric,
    pin_codigo character,
    total numeric)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbinversion_ano
		set 
			ian_ano   	= ano,
			ian_monto 	= monto,
			ian_pin_codigo	= pin_codigo,
			ian_total       = total	
			
		where 
			ian_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;
--select * from tbinversion_ano
--select fn_inversion_anomodificar('IAN001','2013',3,null,30)
--delete from tbinversion_ano where ian_codigo = 'MET001