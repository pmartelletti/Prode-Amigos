function createTable(tableid, url, colnames, colmodel, pagerid, caption, prepareForm, rol){

    var usRol = rol || "admin";
	
	jQuery(tableid).jqGrid({
		url:url,
		datatype: "json",
		colNames:colnames,
		colModel:colmodel,
		rowNum:10,
		rowList:[10,25,50],
		pager: pagerid,
		viewrecords: true,
		caption:caption,
		editurl: url	
	});	
	
	// busqueda por campos	
	jQuery(tableid).jqGrid('filterToolbar',{stringResult: false, searchOnEnter : false});

        if(usRol == "admin"){

             jQuery(tableid).jqGrid('navGrid',pagerid,
                    {}, // general options
                    {height:280,reloadAfterSubmit:true, afterShowForm: prepareForm}, // edit options
                    {height:280,reloadAfterSubmit:true, afterShowForm: prepareForm}, // add options
                    {reloadAfterSubmit:true}, // del options
                    {} // search options
                    );
        }
	
		
	

};