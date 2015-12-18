--INSERTAR
CREATE OR REPLACE FUNCTION fn_inversioninsertar(
    ano character,
    monto numeric,
    total numeric,
    porcentaje numeric,
    sector character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbinversion;			

		IF Cantidad = 0 then
		Codigo = 'INV001';

		ELSE
		select max(inv_codigo) into Codigo from tbinversion;

		Codigo = 'INV' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbinversion(inv_codigo,inv_ano,inv_monto,inv_total,inv_porcentaje,inv_tse_codigo)
		values(Codigo,ano,monto,total,porcentaje,sector);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_inversionmodificar(
    codigo character,
    ano character,
    monto numeric,
    total numeric,
    porcentaje numeric,
    sector character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbinversion
		set 
			inv_ano   	= ano,
			inv_monto 	= monto,
			inv_total 	= total,
			inv_porcentaje	= porcentaje,
			inv_tse_codigo 	= sector
		where 
			inv_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  
--select fn_inversioninsertar('2014',1234,6637,10,null);
--select fn_inversionmodificar('INV001','2013',1234,6637,10,null);

--select * from tbinversion
--delete from tbinversion where inv_codigo = 'VAR002'