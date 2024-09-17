const estado_id = document.getElementById("estado_id");
const municipio_id = document.getElementById('municipio_id')
const parroquia_id = document.getElementById('parroquia_id')

const showMunicipios = (filteredMunicipios)=> {
	municipio_id.innerHTML = '<option value="0">Municipio</option>';

	filteredMunicipios.forEach(item => {
		const option = document.createElement("OPTION")
		option.value = item.id
		option.text = item.municipio 
		municipio_id.appendChild(option)	
	})
}

const filterMunicipios = id => {
	const filteredMunicipios = municipios.filter(item => item.estado_id == id)
	showMunicipios(filteredMunicipios)
}

estado_id.addEventListener('change', e => {
  filterMunicipios(e.target.value)
})

const showParroquias = (filteredParroquias)=> {
	parroquia_id.innerHTML = '<option value="0">Parroquia</option>';

	filteredParroquias.forEach(item => {
		const option = document.createElement("OPTION")
		option.value = item.id
		option.text = item.parroquia 
		parroquia_id.appendChild(option)	
	})
}

const filterParroquias = id => {
	const filteredParroquias = parroquias.filter(item => item.municipio_id == id)
	showParroquias(filteredParroquias)
}

municipio_id.addEventListener('change', e => {
  filterParroquias(e.target.value)
})