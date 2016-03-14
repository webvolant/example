/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.disallowedContent = "table[cellspacing,cellpadding,border,align,summary,bgcolor,frame,rules,width,style]; td[axis,abbr,scope,align,bgcolor,char,charoff,height,nowrap,valign,width]; th[axis,abbr,align,bgcolor,char,charoff,height,nowrap,valign,width]; tbody[align,char,charoff,valign]; tfoot[align,char,charoff,valign]; thead[align,char,charoff,valign]; tr[align,bgcolor,char,charoff,valign]; col[align,char,charoff,valign,width]; colgroup[align,char,charoff,valign,width]";
};

// Set defaults for tables
CKEDITOR.on( 'dialogDefinition', function( ev )
{
	// Take the dialog name and its definition from the event
	// data.
	var dialogName = ev.data.name;
	var dialogDefinition = ev.data.definition;

	// Check if the definition is from the dialog we're
	// interested on (the "Table" dialog).
	if ( dialogName == 'table' )
	{
		// Get a reference to the "Table Info" tab.
		var infoTab = dialogDefinition.getContents( 'info' );
		txtWidth = infoTab.get( 'txtWidth' );
		txtWidth['default'] = '';
		//cmbWidthType = infoTab.get( 'cmbWidthType' );
		//cmbWidthType['default'] = 'percents';
		//txtCellPad = infoTab.get( 'txtCellPad' );
		//txtCellPad['default'] = 4;
	}
});

/*
CKEDITOR.on('dialogDefinition', function( ev ) {
	var dialogName = ev.data.name;
	var dialogDefinition = ev.data.definition;

	if(dialogName === 'table') {
		var infoTab = dialogDefinition.getContents('info');
		var cellSpacing = infoTab.get('txtCellSpace');
		cellSpacing['default'] = "0";
		var cellPadding = infoTab.get('txtCellPad');
		cellPadding['default'] = "0";
		var border = infoTab.get('txtBorder');
		border['default'] = "0";
	}
});*/