// crud function

// define url variable
var url;
			
// create user record
function newUser(){
	$('#dlg').dialog('open').dialog('setTitle','New User');
	$('#fm').form('clear');
	url = 'assets/php/create_user.php';
}

function testUser(){

	var i = 1;

	// loop to resubmit form data
	while(i <= 100){

		$('#fm').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					// sucesss
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});

		// increment counter
		i++

	};

	// once loop finished...
	$('#dlg').dialog('close');		// close the dialog
	$('#dg').datagrid('reload');	// reload the user data

}

// update user record
function editUser(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#dlg').dialog('open').dialog('setTitle','Edit User');
		$('#fm').form('load',row);
		url = 'assets/php/update_user.php?id='+row.id;
	}
}

// validate form submission
function saveUser(){
	$('#fm').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$('#dlg').dialog('close');		// close the dialog
				$('#dg').datagrid('reload');	// reload the user data
			} else {
				$.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}
		}
	});
}

// delete user
function removeUser(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
			if (r){
				$.post('assets/php/delete_user.php',{id:row.id},function(result){
					if (result.success){
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({	// show error message
							title: 'Error',
							msg: result.msg
						});
					}
				},'json');
			}
		});
	}
}