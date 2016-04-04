echo Download dos CSV do Portal SICONV
rm *.csv
while read -r line
do
    name="$line"
    curl -k -O $name 
done < links_siconv.txt

