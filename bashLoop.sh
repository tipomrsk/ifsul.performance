#!/bin/bash

# Defina o número de vezes que deseja executar o comando migrate --seed
# Neste exemplo, vamos executá-lo 10 vezes
total_executions=10

for ((i=1; i<=$total_executions; i++))
do
	php artisan  migrate --seed
done
