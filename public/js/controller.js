var app = {};
app.host = "http://localhost/miral/";

myApp = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

angular.module('myApp').directive('pwCheck', [function () {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            var firstPassword = '#' + attrs.pwCheck;
            elem.add(firstPassword).on('keyup', function () {
                scope.$apply(function () {
                    var v = elem.val()===$(firstPassword).val();
                    ctrl.$setValidity('pwmatch', v);
                });
            });
        }
    }
}]);

angular.module('myApp').controller('LoginController', function($scope, $http, $window){
    $scope.err = 0;
    $scope.doLogin = function(){
        var data = $.param({
            username: $scope.email_address,
            password: $scope.password
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post('processLogin', data, config).success(function (result, status) {

            if(result == -1)
            {
                $scope.err = 1;
                $scope.login_msg = "Invalid email address / password. Please try again.";
                console.log($scope.login_msg)
            }
            else
            {
                $scope.err = 0;
                localStorage.setItem('loginUser', JSON.stringify(result));
                console.log(localStorage)
                $window.location.href = 'dashboard';
            }
        }).error(function (result, status) {

            $scope.err = 1;
            $scope.login_msg = "Internal problem occured. Please contact the administrtator.";
        });
    };
});

angular.module('myApp').controller('NewsController', function($scope, $http, $window){
    $scope.deleteNews = function(id){
		$scope.news_id = id;
		$('#modalSlideUp2').modal('show')
	}
	
	$scope.confirmRemoveNews = function(){
		$http.get(app.host + 'news/remove/'+$scope.news_id).then(function(response){
            toastr.success('News has been removed successfully.', 'Notification')
            toastr.options.closeButton = true;
            window.location.href = app.host + 'news/list';
        })
	}
});

angular.module('myApp').controller('ClientController', function($scope, $http, $window) {
    $scope.msg = "";
    $scope.initialize = function(user_type){
        $scope.user_type = user_type;
        $http.get(app.host + 'getUsersList/'+$scope.user_type).then(function(response){
            $scope.users_list = response.data.users;
        })
        $http.get(app.host + 'roles').then(function(response){
            $scope.roles = response.data.roles;
        })
    }
    $scope.delete_user = function(user_id, user_type){
        $('#success-modal_2').modal('show')
        $('#delete_user_confirm_btn').attr('user_id', user_id)
        $('#delete_user_confirm_btn').attr('user_type', user_type)
    }
    $scope.checkEmail = function(){
        var data = $.param({
            email: $('#email_address').val(),
            user_type: $('#user_reg_btn').attr('user_type')
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'checkEmail', data, config).success(function (result, status) {
            console.log(result)
            if(result == -1)
                $scope.error_msg = 1
            else
                $scope.error_msg = 0;
            //  alert($scope.error_msg)
        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.delete_user_confirm = function()
    {
        user_id = $('#delete_user_confirm_btn').attr('user_id');
        user_type = $('#delete_user_confirm_btn').attr('user_type');
        $http.get(app.host + 'deleteUser/'+user_type+'/'+user_id).then(function(response){
            toastr.success('User has been successfully removed from the system!', 'Notification')
            toastr.options.closeButton = true;
            $('#success-modal_2').modal('toggle')
            window.location.href = app.host + 'dashboard/'+user_type+'/list';
        })
    }
    $scope.registerUser = function(form, user_type){
        //alert(document.getElementsByName('_token')[0].value)
        var data = $.param({
            first_name: $scope.user.first_name,
            last_name: $scope.user.last_name,
            email_address: $scope.user.email_address,
            password: $scope.user.password,
            company: $scope.user.company,
            account_type: $scope.user.account_type,
            user_type: user_type,
            role_id: $scope.user.role,
            _token: document.getElementsByName('_token')[0].value,
        });
        console.log(data)
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'registerUser', data, config).success(function (result, status) {
            if(result == -1)
            {
                $scope.msg = "Email address already exists.";
            }
            else
            {
                $('#success-modal').modal('toggle');
                $scope.msg = "";
                $scope.user = {};
                form.$setPristine();
                $http.get(app.host + 'getUsersList/'+user_type).then(function(response){
                    $scope.users_list = response.data.users;
                })
            }

        }).error(function (result, status) {
            console.log(result)
        });
    };
})

angular.module('myApp').controller('RoleController', function($scope, $http, $window) {
    $scope.loadRoles = function(){
        $http.get(app.host + 'roles').then(function(response){
            $scope.roles = response.data.roles;
        })
    };
    $scope.addRole = function(form, user_type){
        var data = $.param({
            name: $scope.role.name,
            description: $scope.role.description
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'roles', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');

            $scope.role = {};
            form.$setPristine();
            $http.get(app.host + 'roles').then(function(response){
                $scope.roles = response.data.roles;
            })
        }).error(function (result, status) {
            console.log(result)
        });
    };

    $scope.assignPermission = function (role_id) {
        var data = $.param({
            role_id: role_id,
            permission_list: $scope.permission_list
        });
        console.log('----')
        console.log(data)
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'assignPermissions', data, config).success(function (result, status) {

            console.log(result)

        }).error(function (result, status) {
            console.log(result)
        });
    }

    $scope.selectPermission = function (permission_status, val, id) {

        action = permission_status.permissions_id;

        $http.get(app.host + 'assignPermissions/'+action+'/'+val+'/'+id).then(function(response){
            console.log(response)
        }, function(response){

        })
    }
    $scope.loadPermissions = function(){
        $http.get(app.host + 'permissions').then(function(response){
            $scope.permissions = response.data.permissions;
        })
        $scope.permission_list = [];
    };

    $scope.addPermission = function(form, user_type){
        var data = $.param({
            name: $scope.permission.name,
            display_name: $scope.permission.display_name,
            description: $scope.permission.description
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'permissions', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');

            $scope.permission = {};
            form.$setPristine();
            $http.get(app.host + 'permissions').then(function(response){
                $scope.permissions = response.data.permissions;
            })
        }).error(function (result, status) {
            console.log(result)
        });
    };
})
angular.module('myApp').controller('LocationController', function($scope, $http, $window) {
    $scope.getDistrictList = function()
    {
        $http.get(app.host + 'getDistrictList').then(function(response){
            $scope.districts = response.data.districts;
        })
    }
    $scope.removeCourierFromBranch = function (courier_id, location_id) {

        $('#modalSlideUp2').modal('toggle')
        $scope.courier_id = courier_id;
        $scope.location_id = location_id;
        /*$http.get(app.host + 'dashboard/courier/remove_from_branch/'+courier_id).then(function(response){
            toastr.success('Courier has been successfully removed from the branch!', 'Notification')
            toastr.options.closeButton = true;
            window.location.href = app.host + 'dashboard/locations/all';
        })*/
    }
    $scope.confirmRemoveCourierFromBranch = function (courier_id, location_id) {

        $http.get(app.host + 'dashboard/courier/remove_from_branch/'+$scope.courier_id).then(function(response){
            toastr.success('Courier has been successfully removed from the branch!', 'Notification')
            toastr.options.closeButton = true;
            window.location.href = app.host + 'dashboard/locations/all';
        })
    }
    $scope.delete_cycle_confirm = function()
    {
        cycle_id = $('#delete_cycle_confirm_btn').attr('cycle_id');

        $http.get(app.host + 'deleteCycle/'+cycle_id).then(function(response){
            console.log(response)
            $('#success-modal_2').modal('toggle')
            window.location.href = app.host + 'dashboard/cycles/all';
        })
    }
    $scope.delete_location_confirm = function()
    {
        location_id = $('#delete_location_confirm_btn').attr('location_id');

        $http.get(app.host + 'deleteLocation/'+location_id).then(function(response){
            console.log(response)
            $('#success-modal_2').modal('toggle')
          window.location.href = app.host + 'dashboard/locations/all';
        })
    }
    $scope.delete_route_confirm = function()
    {
        route_id = $('#delete_route_confirm_btn').attr('route_id');

        $http.get(app.host + 'deleteRoute/'+route_id).then(function(response){
            console.log(response)
            $('#success-modal_2').modal('toggle')
            window.location.href = app.host + 'dashboard/routes/all';
        })
    }
    $scope.getRelaventDistricts = function()
    {
        $http.get(app.host + 'getRelaventDistricts').then(function(response){
            $scope.districts2 = response.data.districts2;
        })
    }
    $scope.loadLocationsList = function(){
        $http.get(app.host + 'getLocationsList').then(function(response){
            $scope.locations = response.data.locations;
        })
    }
    $scope.loadCouriersInLocationsList = function(loc_id)
    {
        $http.get(app.host + 'getLocationBasedCouriersList/'+loc_id).then(function(response){
            $scope.location_based_couriers = response.data.couriers;
            console.log(response.data.couriers)
        })
    }
    $scope.removeArea = function(area_id, location_id) {
        $('#modalSlideUp3').modal('toggle');

        $scope.current_area_id = area_id;
        $scope.current_location_id = location_id;
        /*$http.get(app.host + 'removeAreaFromLocation/'+area_id).then(function(response){
            console.log(response)
            window.location.href = app.host + 'dashboard/locations/view/'+location_id;
        })*/
    }
    $scope.removeAreaConfirmed = function(area_id, location_id) {
        $http.get(app.host + 'removeAreaFromLocation/'+$scope.current_area_id).then(function(response){
            console.log(response)
            window.location.href = app.host + 'dashboard/locations/view/'+$scope.current_location_id;
        })
    }
    $scope.addCourierToLocation = function(myform, loc_id, courier_id){

        var data = $.param({
            location_id: loc_id,
            courier_id: courier_id
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'location/addCourier', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');
            /*$('.top-right').notify({
             type: 'info',
             message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
             closable: false,
             fadeOut: { enabled: true, delay: 2000 }
             }).show();*/

            $scope.location = {};
            myform.$setPristine();
            $scope.loadCouriersInLocationsList(loc_id);
            $scope.loadLocationsList();
            window.location.href = app.host + 'dashboard/locations/view/'+loc_id


        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.addAreaToLocation = function(myform, loc_id, area_id){

        var data = $.param({
            location_id: loc_id,
            area_id: area_id
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'location/addArea', data, config).success(function (result, status) {
            console.log(result)
            $('#modalSlideUp1').modal('toggle');
            /*$('.top-right').notify({
             type: 'info',
             message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
             closable: false,
             fadeOut: { enabled: true, delay: 2000 }
             }).show();*/
            console.log(result);

            $scope.location = {};
            myform.$setPristine();
            $scope.loadCouriersInLocationsList(loc_id);
            $scope.loadLocationsList();
            window.location.href = app.host + 'dashboard/locations/view/'+loc_id


        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.viewLocationEditModal = function(id)
    {
        $('#modalSlideUp2').modal('show');
        $http.get(app.host + 'dashboard/locations/get/'+id).then(function(response){
            console.log(response)
            $scope.locations = response.data.locations;
        })

    }
    $scope.viewCycleEditModal = function(id)
    {
        $('#modalSlideUp2').modal('show');
        $http.get(app.host + 'dashboard/cycle/get/'+id).then(function(response){
            console.log(response)
            $scope.cycles = response.data.cycles;
        })

    }
    $scope.viewRouteEditModal = function(route_id, sender_dist_id, receiver_dist_id)
    {
        $('#modalSlideUp2').modal('show');
        $('#this_route_id').val(route_id);
    }
    $scope.updateLocation = function(myform){
        var data = $.param({
            id: $('#location_id').val(),
            location_name: $('#location_name').val(),
            address: $('#location_address').val(),
            contact_name: $('#location_contact_name').val(),
            contact_number: $('#location_contact_number').val(),
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'location/update', data, config).success(function (result, status) {
            window.location.href = app.host + 'dashboard/locations/all';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.updateCycle = function(myform){
        var data = $.param({
            id: $('#cycle_id').val(),
            cycle_number: $('#this_cycle_number').val(),
            given_date: $('#this_given_date').val(),
            courier_id: $('#this_courier_id').val(),
            comments: $('#this_comment').val(),
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'cycle/update', data, config).success(function (result, status) {
            console.log(result)
            window.location.href = app.host + 'dashboard/cycles/all';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.updateRoute = function(myform){
        var data = $.param({
            id: $('#this_route_id').val(),
            sender_dist_id: $('#this_from').val(),
            receiver_dist_id: $('#this_to').val(),
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'route/update', data, config).success(function (result, status) {
            console.log(result)
            window.location.href = app.host + 'dashboard/routes/all';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.delete_location = function(id)
    {
        $('#success-modal_2').modal('show')
        $('#delete_location_confirm_btn').attr('location_id', id)
    }
    $scope.delete_route = function(id)
    {
        $('#success-modal_2').modal('show')
        $('#delete_route_confirm_btn').attr('route_id', id)
    }
    $scope.delete_cycle = function(id)
    {
        $('#success-modal_2').modal('show')
        $('#delete_cycle_confirm_btn').attr('cycle_id', id)
    }
    $scope.addLocation = function(myform){
        var data = $.param({
            location_name: $scope.location.location_name,
            address: $scope.location.address,
            contact_name: $scope.location.contact_name,
            contact_number: $scope.location.contact_number,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'location/add', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');
            window.location.href = app.host + 'dashboard/locations/all';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.checkCycleNumber = function(){
        var cycle_number = $('#cycle_number').val();
        $http.get(app.host + 'checkCycleNumber/'+cycle_number).then(function(response){
            console.log('--')
            $scope.count_cycle_number = response.data.count;
            console.log(response)
        })
    }
    $scope.addCycle= function(myform){
        var data = $.param({
            bicycle_number: $scope.cycle.cycle_number,
            given_date: $scope.cycle.date,
            courier_id: $scope.cycle.courier_id,
            comments: $scope.cycle.comment,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'cycle/add', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');
            window.location.href = app.host + 'dashboard/cycles/all';

        }).error(function (result, status) {
            console.log(result)
        });
    }
})
angular.module('myApp').controller('OrderController', function($scope, $http, $window) {

		var n = 0;
		var items = new Array();
		$scope.items = new Array();
		$scope.user = {};
		$scope.loadOrdersList = function(order_status){
		$("#jsGrid").jsGrid({
            height: "90%",
            width: "100%",

            filtering: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            deleteConfirm: function(item) {
                return "The client \"" + item.Name + "\" will be removed. Are you sure?";
            },
            pageSize: 15,
            pageButtonCount: 5,

            controller: {
                loadData: function() {
                    var d = $.Deferred();

                    $.ajax({
                        url: app.host + 'loadOrders',
                        dataType: "json"
                    }).done(function(response) {
                        console.log(22222222)
                        $scope.orders = response.orders;
                        console.log($scope.orders)
                        d.resolve($scope.orders);
                    }).error(function(response) {
                        console.log('dd')
                        console.log(response)
                    });

                    return d.promise();
                }
            },

            fields: [
                { type: "control", width: 100,modeSwitchButton: false, editButton: false, deleteButton: false ,
                    
                },
                { name: "flag", type: "text", width: 150 }
            ]
        });	 
        $http.get(app.host + 'getOrdersList/'+order_status).then(function(response){
            console.log('--')
            console.log(response)
            $scope.orders = response.data.orders;
            $scope.locations = response.data.locations;
        })
    }
    $scope.delete_order = function(order_id){
        $('#success-modal_2').modal('show')
        $('#delete_order_confirm_btn').attr('order_id', order_id)
    }
    $scope.deny_order = function(order_id){
        $('#success-modal_3').modal('show')
        $('#deny_order_confirm_btn').attr('order_id', order_id)
    }
	
	$scope.rejectHandover = function(order_id){
		$('#modalSlideUp2').modal('toggle');
		$scope.rejected_handover_order = order_id;
		$scope.handover_flag = 2;
	}
	$scope.approveHandover = function(order_id){
		$('#modalSlideUp2').modal('toggle');
		$scope.rejected_handover_order = order_id;
		$scope.handover_flag = 1;
	}
	$scope.money = 0;
	$scope.acceptAmount = function(id){
		$('#modalSlideUp2').modal('show');
		$scope.account_id = id;
		/* $http.get(app.host + 'acceptAmount/'+id).then(function(response){
            
        }) */
	}
	$scope.denyAmount = function(id){
		$('#modalSlideUp3').modal('show');
		$scope.account_id = id;
		/* $http.get(app.host + 'acceptAmount/'+id).then(function(response){
            
        }) */
	}
	$scope.confirmAcceptAmount = function(flag){
		
		$http.get(app.host + 'acceptAmount/'+$scope.account_id+"/"+flag).then(function(response){
			console.log(response);
            $('#modalSlideUp2').modal('hide');
			toastr.success('Operation has been successful!', 'Notification')
			toastr.options.closeButton = true;
			window.location.href = app.host + 'dashboard/accounts/deposits';
        })
	}
	$scope.getPaymentMethod = function(payment_method){
		if(payment_method == 'cash')
		{
			$('.bank_div').css('display', 'none')
			$('.cash_div').css('display', 'inline')
		}
		else 
		{
			$('.bank_div').css('display', 'inline')
			$('.cash_div').css('display', 'none')
		}
	}
	$scope.checkHandover = function(id){
		
		var money = $('#mycheck_'+id).attr('money')
		if($('#mycheck_'+id).is(':checked'))
			$scope.money = Number($scope.money) + Number(money);
		else
			$scope.money = Number($scope.money) - Number(money);
	
		if($scope.money == 0)
		{
			$('#total_amount_btn').css('display', 'none');
		}
		else 
		{
			$('#total_amount_btn').css('display', 'inline');
			$('#total_amount_btn').html('Total Amount : '+$scope.money);
		}
		console.log(money)
	}
	
	$scope.confirmRejectHandover = function(){
		$http.get(app.host + 'handoverMoney/'+$scope.rejected_handover_order+'/'+$scope.handover_flag).then(function(response){
        window.location.href = app.host + 'dashboard/reports/accounts';
        })
	}
    $scope.checkAllCheckbox = function()
    {
        if($('#check_main').prop('checked'))
        {

            $('.checkboxclass').prop('checked','checked');
        }
        else{
            $('.checkboxclass').prop('checked',false);
        }

        
    }

    $scope.viewDashboard = function(orders){
    var myChart1 = document.getElementById("myChart1");
    var myChart2 = document.getElementById("myChart2");
    var myChart3 = document.getElementById("myChart3");
    var myChart4 = document.getElementById("myChart4");
    
    $http.get(app.host + 'dashboard/statements/monthly').then(function(response){
            total_orders = new Array();
            total_customers = new Array();
            months = new Array();
            customer_months = new Array();
           for(i=0;i<response.data.orders.length;i++)
            {
                total_orders.push(response.data.orders[i].total_orders)
				var month_list = ["Juanuary", "February", "March", "April","May", "June", "July", "August", "Septembar", "Octobar", "Novembar", "Decembar"];
				
                months.push(month_list[response.data.orders[i].this_month-1])
            }
            $scope.total_orders = total_orders;
			
           for(i=0;i<response.data.customers.length;i++)
            {
                total_customers.push(response.data.customers[i].total_customers)
                customer_months.push(response.data.customers[i].this_month)
            }
            $scope.total_customers = total_customers;
			
            var myChart = new Chart(myChart1, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [
                            {
                                label: "Monthly Orders",
                                fill: false,
                                backgroundColor: "#37d177",
                                borderColor: "#37d177",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "rgba(75,192,192,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "343d3e",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: $scope.total_orders,
                                spanGaps: false
                            }/* ,
                            {
                                label: "Total Customers",
                                fill: false,
                                backgroundColor: "#FFCE56",
                                borderColor: "#FFCE56",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "rgba(75,192,192,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "#FFCE56",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: $scope.total_customers,
                                spanGaps: false
                            }  */
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            var dataPie = {
                labels: [
                    "Pending",
                    "Approved",
                    "Delivered"
                ],
                datasets: [
                    {
                        data: [
                                response.data.no_of_order_pending,
                                response.data.no_of_order_approved,
                                response.data.no_of_order_delivered
                              ],
                        backgroundColor: [
                            "rgba(55, 209, 119, 0.45)",
                            "#FFCE56",
                            "rgba(175, 175, 175, 0.26)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(55, 209, 119, 0.6)",
                            "#FFCE56",
                            "rgba(175, 175, 175, 0.4)"
                        ]
                    }]
            };

            var pieChar = new Chart(myChart2, {
                type: 'doughnut',
                data: dataPie

            });

            var dataBars = {
                labels: ["January", "February", "March", "April", "May"],
                datasets: [
                    {
                        label: "Data 1",
                        fill: true,
                        backgroundColor: "rgba(55, 209, 119, 0.45)",
                        borderColor: "rgba(55, 209, 119, 0.45)",
                        data: [12, 13, 11, 6, 9]
                    },
                    {
                        label: "Data 2",
                        fill: true,
                        backgroundColor: "rgba(175, 175, 175, 0.26)",
                        borderColor: "rgba(175, 175, 175, 0.26)",
                        data: [14, 6, 9, 13, 12],
                    }
                ],
                options: {
                    scales: {
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            };

            var barChar = new Chart(myChart3, {
                type: 'bar',
                data: dataBars,

            });

            var dataBubble = {
                animation: {
                    duration: 10000
                },
                datasets: [{
                    label: "Data 1",
                    backgroundColor: "rgba(55, 209, 119, 0.45)",
                    borderColor: "rgba(55, 209, 119, 1)",
                    borderWidth: 1,
                    data: [{
                        x: 46,
                        y: 15,
                        r: 7
                    }, {
                        x: 56,
                        y: 38,
                        r: 9
                    }, {
                        x: 36,
                        y: 15,
                        r: 4
                    }, {
                        x: 99,
                        y: 75,
                        r: 3
                    }]
                }, {
                    label: "Data 2",
                    backgroundColor: "#FFCE56",
                    borderColor: "#FFCE56",
                    borderWidth: 1,
                    data: [{
                        x: 86,
                        y: 75,
                        r: 8
                    }, {
                        x: 35,
                        y: 53,
                        r: 3
                    }, {
                        x: 85,
                        y: 23,
                        r: 7
                    }, {
                        x: 66,
                        y: 54,
                        r: 4
                    }]
                }]
            };
            var bubbleChar = new Chart(myChart4, {
                type: 'bubble',
                data: dataBubble

            });
        })
    
    }
    var chkarr = "";
	
	$scope.disburseAmount = function()
	{
		var chk = $('.checkboxclass');
	
        for(i=0;i<chk.length;i++)
        {
            if($('#mycheck_'+i).prop('checked'))
            {     
                chkarr +=$('#mycheck_'+i).attr('order_id');
                chkarr += "_";
            }
        }

		$http.get(app.host + 'disburseMoney/'+chkarr).then(function(response){
			toastr.success('Operation has been successful!', 'Notification')
			toastr.options.closeButton = true;
			window.location.href = app.host + 'dashboard/accounts/disburse';
        })
	}
    $scope.updateAllAccount = function()
    {
        var chk = $('.checkboxclass');
	
        for(i=0;i<chk.length;i++)
        {
            if($('#mycheck_'+i).prop('checked'))
            {     
                chkarr +=$('#mycheck_'+i).attr('order_id');
                chkarr += "_";
                console.log(chkarr)
            }
        }
        $http.get(app.host + 'handoverAll/'+chkarr).then(function(response){
        
        })
        toastr.success('Operation has been successful!', 'Notification')
        toastr.options.closeButton = true;
        window.location.href = app.host + 'dashboard/reports/accounts';
}
$scope.resolveComplain  = function(complain_id)
    {
        if($('#check-h2_'+complain_id).prop('checked'))
        {

            var flag = '1';
        }
        else{
            var flag = '0';
        }
        $http.get(app.host + 'resolveComplain/'+complain_id+'/'+flag).then(function(response){
            if(flag == '1')
            {
                toastr.success('Complain status has been changed!', 'Notification')
                toastr.options.closeButton = true;
            }
            else if(flag == '0')
            {
                toastr.warning('Complain status has been changed!', 'Notification')
                toastr.options.closeButton = true;
            }
        })
    }
    $scope.handoverMoney = function(order_id)
    {
        $http.get(app.host + 'handoverMoney/'+order_id).then(function(response){
            
            toastr.success('You handed over the money to branch manager!', 'Notification')
                toastr.options.closeButton = true;
                $('#'+order_id).prop('disabled', 'disabled')
                $('#'+order_id).text('Handed Over')
                $('#'+order_id).removeClass('btn-success')
                $('#'+order_id).addClass('btn-danger')
        }, function(response){
        })
    }
    $scope.accept_order = function(order_id){
        $('#success-modal_4').modal('show')
        $('#accept_order_confirm_btn').attr('order_id', order_id)
    }

    $('#receiver_name').blur(function(){
        name = $('#receiver_name').val();
        $http.get(app.host + 'fetchReceiverDetails/'+name).then(function(response){
            $scope.receiver_details = response.data.user_details;
          
        }, function(response){
          
        })
    })
    $('#user_id').change(function(){
        user_id = $('#user_id').val();
        if(user_id == "")
        {
            $scope.sender_email = "";
        }
        else
        {
            $http.get(app.host + 'fetchUserDetails/'+user_id).then(function(response){
                $scope.sender_email = response.data.user[0].email;
                $scope.user.sender_phone = response.data.user[0].phone;
               
                $scope.user_details = response.data.user_details;
                $scope.addresses_list = response.data.addresses_list;
                $scope.account_type = response.data.user[0].account_type;

                if($scope.account_type == 2)
                    $scope.unit_price = 15;
                else
                    $scope.unit_price = 20;
                console.log(response)
            }, function(response){
                console.log(response)
            })
        }


    });
    $scope.delete_order_confirm = function()
    {
        order_id = $('#delete_order_confirm_btn').attr('order_id');
        $http.get(app.host + 'delete_order/'+order_id).then(function(response){
            $('#success-modal_2').modal('toggle')
            window.location.href = app.host + 'dashboard/orders/all/pending';
        }, function(response){
            console.log(response)
        })
    }
    $scope.deny_order_confirm = function()
    {
        order_id = $('#deny_order_confirm_btn').attr('order_id');
        courier_id = $('#deny_order_confirm_btn').attr('courier_id');

        var data = $.param({
            order_id: order_id,
            courier_id: courier_id,
            deny_reason: $('#deny_reason').val(),
            deny_reason_2: $('#deny_reason_2_details').val(),
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'order/deny', data, config).success(function (result, status) {

            $window.location.href = app.host + 'dashboard/orders/all/new';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.accept_order_confirm = function()
    {
        order_id = $('#accept_order_confirm_btn').attr('order_id');
        courier_id = $('#accept_order_confirm_btn').attr('courier_id');

        var data = $.param({
            order_id: order_id,
            courier_id: courier_id,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'order/accept', data, config).success(function (result, status) {

            $window.location.href = app.host + 'dashboard/orders/all/new';

        }).error(function (result, status) {
            console.log(result)
        });
    }
    $scope.openModal = function(id){
        $('#select_location').attr('order_id', id)
        $('#success-modal').modal('show');
    }
    $scope.getUserType = function(){
        val = $('#sender_id').val();
        index = val.indexOf('-');
        $scope.account_type = val.substr(index+1);
        if($scope.account_type == 2)
        {
            $scope.rate = 15
        }
        else
        {
            $scope.rate = 20;
        }
    }
    $scope.initialize = function(){
        var autocomplete = {};
        var autocompletesWraps = ['test', 'test2'];
        var test_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };
        var test2_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };

        $.each(autocompletesWraps, function(index, name) {

            if($('#'+name).length == 0) {
                return;
            }

            autocomplete[name] = new google.maps.places.Autocomplete($('#'+name+' .autocomplete')[0], { types: ['geocode'] });

            google.maps.event.addListener(autocomplete[name], 'place_changed', function() {

                var place = autocomplete[name].getPlace();
                var form = eval(name+'_form');

                for (var component in form) {
                    $('#'+name+' .'+component).val('');
                    $('#'+name+' .'+component).attr('disabled', false);
                }

                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (typeof form[addressType] !== 'undefined') {
                        var val = place.address_components[i][form[addressType]];
                        $('#'+name+' .'+addressType).val(val);
                    }
                }
            });
        });

    }
    $http.get(app.host + 'getUsersList/clients').then(function(response){
        $scope.users_list = response.data.users;
    })

    $scope.addOrder = function (myform) {
        //console.log($('#item_details').val())
        price = $("input[name='price']:checked").val();

        if(!$scope.OrderRequestForm.$valid || !price)
        {

            console.log(price)
            $scope.isFormInvalid = true;
            return false;
        }

        var data = $.param({
            user_id: $scope.user.user_id,
            sender_email: $scope.user.sender_email,
            sender_phone: $scope.user.sender_phone,
            sender_street: $('#sender_street').val(),
            sender_address_1: $('#sender_address').val(),
            sender_city: $('#sender_city').val(),
            sender_state: $('#sender_state').val(),
            sender_district: $('#sender_district').val(),
            sender_upazilla: $('#sender_upazilla').val(),
            sender_zipcode: $('#sender_zipcode').val(),
            sender_country: $('#sender_country').val(),
            reciever_name: $scope.user.reciever_name,
            reciever_email: $scope.user.reciever_email,
            reciever_phone: $scope.user.reciever_phone,
            reciever_street: $('#receiver_street').val(),
            reciever_address_1: $('#reciever_address_2').val(),
            reciever_city: $('#reciever_city_2').val(),
            receiver_district: $('#receiver_district').val(),
            reciever_state: $('#reciever_state_2').val(),
            receiver_upazilla: $('#receiver_upazilla').val(),
            receiver_zipcode: $('#receiver_zipcode').val(),
            reciever_country: $('#reciever_country_2').val(),
            pickup_date: $scope.user.pickup_date,
            payment_method: $('#payment_method').val(),
            doc_type: $('#doc_type').val(),
            delivery_type: $('#delivery_type').val(),
            shipment_info: $scope.newItems,
            shipment_purpose: $('#shipment_purpose').val(),
            shipping_amount: $('#shipping_amount').val(),
            price: price
        });

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'orders/add', data, config).success(function (result, status) {
            console.log(result)

            $scope.user = {};
            myform.$setPristine();
            n = 0;
            items = new Array();
            $scope.items = new Array();
            /*$('.autocomplete').val('');
             $('#sender_street').val('');
             $('#sender_address').val('');
             $('#sender_city').val('');
             $('#sender_state').val('');
             $('#sender_state').val('');
             $('#sender_postcode').val('');
             $('#sender_country').val('');

             $('#sender_street_2').val('');
             $('#sender_address_2').val('');
             $('#sender_city_2').val('');
             $('#sender_state_2').val('');
             $('#sender_state_2').val('');
             $('#sender_postcode_2').val('');
             $('#sender_country_2').val('');*/
            $window.location.href = app.host + 'dashboard/order/'+result;


        }).error(function (result, status) {
            console.log(result)
        });
    }

    total_qty = 0;
    total_weight = 0;
    $("#payment_method").change(function(){
        if($("#payment_method").val() == "Cash on Delivery")
        {
            $("#sku_idv").css('display', 'block')
            $("#item_price_div").css('display', 'block')
            $("#discount_div").css('display', 'block')
            $("#subtotal_div").css('display', 'block')
            $("#shipment_cost_div").css('display', 'block')
        }
        else
        {
            $("#sku_idv").css('display', 'none')
            $("#item_price_div").css('display', 'none')
            $("#discount_div").css('display', 'none')
            $("#subtotal_div").css('display', 'none')
            $("#shipment_cost_div").css('display', 'none')
        }
    });
    $('.calculate_subtotal').blur(function(){
        subtotal = $('#qty').val()*$('#item_price').val()-$('#discount').val();
        $('#subtotal').val(subtotal);
    })
    $('#shipping_cost').blur(function(){
        $('#total_cost').val(Number($('#subtotal').val())+Number($('#shipping_cost').val()));
    })
    $scope.addNewItem = function()
    {
        var sender_dist = $('#sender_district').val();
        var receiver_dist = $('#receiver_district').val();
        $scope.sender_dist = sender_dist;
        $scope.receiver_dist = receiver_dist;
        doc_type = $('#doc_type').val();
        purpose = $('#purpose').val();
        payment_method = $('#payment_method').val();
        delivery_type = $('#delivery_type').val();
        prod_height = $('#prod_height').val();
        prod_width = $('#prod_width').val();
        prod_length = $('#prod_length').val();
        if(doc_type == 'parcel')
        {
            $('#parcel_div').css('display', 'block')
            $('#doc_div').css('display', 'none')
            delivery_item_type = $('#parcel_item_input').val();
        }
        else if(doc_type == 'document')
        {
            $('#parcel_div').css('display', 'none')
            $('#doc_div').css('display', 'block')
            delivery_item_type = $('#doc_item_input').val();
        }
        qty = $('#qty').val();
        item_price = $('#item_price').val();
        if($('#weight').val() != "")
        {
            weight = $('#weight').val();
        }
        else
        {
            weight = "-";
        }
        if($('#sku').val() != "")
        {
            sku = $('#sku').val();
        }
        else
        {
            sku = "-";
        }

        discount = $('#discount').val();;
        subtotal = $('#subtotal').val();
        if($("#payment_method").val() != "Cash on Delivery")
        {
            subtotal = "-";
            discount = "-";
            item_price = "-";
        }
        /*shipping_cost = $('#shipping_cost').val();
        total_cost = $('#total_cost').val();*/
        items[n] = [doc_type, purpose, payment_method, delivery_type, delivery_item_type, qty, weight, item_price, sku, discount, subtotal, prod_height, prod_width, prod_length];

        $('#item_details').val(items)
        n++;
        total_qty = Number(total_qty) + Number(qty);
        total_weight = Number(total_weight) + Number(weight);
        if($("#payment_method").val() != "Cash on Delivery")
        {
            subtotal = "-";
            discount = "-";
        }

        $('#items_table').css('display','block');
        $('#items_table_tr').append(
            "<tr>" +
            "<td>"+delivery_item_type+"</td>" +
            "<td>"+sku+"</td>" +
            "<td>"+qty+"</td>" +
            "<td>"+weight+"</td>" +
            "<td>"+item_price+"</td>" +
            "<td>"+discount+"</td>" +
            "<td>"+subtotal+"</td>" +
            "</tr>"
        );

        $scope.newItems = items;
        $scope.total_price = total_qty*$scope.unit_price;

        if(doc_type == 'parcel')
        {
            var data = $.param({
                from: $scope.sender_dist,
                to: $scope.receiver_dist,
                total_weight: total_weight,
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };
                $http.post(app.host + 'getPriceQuotion', data, config).success(function (result, status) {

                    console.log('--+++++++++++-')
                    console.log(result)
                    if(result == -1)
                    {
                        $scope.msg = "Price quotation not available for this route/weight.";
                        $scope.total_weight = 0;
                        items[n] = new Array();
                        delete $scope.items;

                        $('#sender_district').attr('disabled', false);
                        $('#receiver_district').attr('disabled', false);
                        return;
                    }
                    else{
                        $scope.msg = "";
                        $scope.prices = result;
                    }


                }).error(function (result, status) {
                    console.log(result)
                });
        }

    }

    var count = 0;
    $scope.total_weight = 0;
    $('#doc_type').change(function(){
        $('#fieldset_div').css('display', 'block')
        $('#doc_type').attr('disabled', 'disabled')
        if($('#doc_type').val() == 'parcel')
        {

            $('.parcel_element').attr('disabled', false);
            $('#parcel_item_input').css('display', 'block');
            $('#doc_item_input').css('display', 'none');
        }
        if($('#doc_type').val() == 'document')
        {

            $('.parcel_element').attr('disabled', 'disabled');
            $('#parcel_item_input').css('display', 'none');
            $('#doc_item_input').css('display', 'block');
        }

    })
    $scope.deleteItem = function (id, weight, qty) {

        $scope.items.splice(id, 1)
        console.log($scope.items)
        new_items = new Array();
        for(i=0; i<$scope.items.length; i++)
        {
            new_items[i] = [ $scope.items[i][0],$scope.items[i][1],$scope.items[i][2], $scope.items[i][3]   ]
        }

        $scope.items = new Array();
        $scope.items = new_items;
        console.log('----------<')
        console.log($scope.items)
        console.log($scope.items.length)
        $scope.total_qty -= qty;
        $scope.total_price = $scope.total_qty*$scope.unit_price;
        $scope.total_weight -= Number(weight);
        $scope.total_items = $scope.items.length;
        val = $('#doc_type').val();
        var data = $.param({
            from: $scope.sender_dist,
            to: $scope.receiver_dist,
            total_weight: $scope.total_weight,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        if(val == 'parcel')
        {
            $http.post(app.host + 'getPriceQuotion', data, config).success(function (result, status) {

                console.log('--+++++++++++-')
                console.log(result)
                if(result == -1)
                {
                    $scope.msg = "Price quotation not available for this route/weight.";
                    $scope.total_weight = 0;
                    items[n] = new Array();
                    delete $scope.items;

                    $('#sender_district').attr('disabled', false);
                    $('#receiver_district').attr('disabled', false);
                    return;
                }
                else{
                    $scope.prices = result;
                }


            }).error(function (result, status) {
                console.log(result)
            });
        }
        console.log($scope.items)
    }
    $scope.num_of_item = 0;
    $scope.total_weight = 0;
    $scope.total_qty = 0;
    $scope.addItem = function(){

        var sender_dist = $('#sender_district').val();
        var receiver_dist = $('#receiver_district').val();
        $scope.sender_dist = sender_dist;
        $scope.receiver_dist = receiver_dist;
        var doc_type = $('#doc_type').val();
        var user_id = $('#user_id').val();
        if(false)
        {
            $scope.msg = "Please chose sender and receiver information.";
            return;
        }
        else
        {
            $('#sender_district').attr('disabled', 'disabled');
            $('#receiver_district').attr('disabled', 'disabled');
        }
        var data = $.param({
            from: sender_dist,
            to: receiver_dist,
            total_weight: Number($scope.total_weight) + (Number($('#qty').val())*Number($scope.user.weight)),
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        if(doc_type == 'parcel')
        {
            $http.post(app.host + 'getPriceQuotion', data, config).success(function (result, status) {

                if(result == -1)
                {
                    $scope.msg = "Price quotation not available for this weight.";
                    return;
                }
                else
                {
                    if(isNaN($scope.user.weight))
                        $scope.user.weight = 0
                    else
                        $scope.user.weight = $scope.user.weight
                    $scope.total_weight += (Number($('#qty').val())*Number($scope.user.weight));
                    $scope.num_of_item += Number($scope.num_of_item)+Number($('#qty').val());

                    $('#doc_type').attr('disabled', 'disabled')
                    if($scope.total_weight > 10)
                    {
                        $scope.msg = "Total Weight must be up to 10 kg.";
                        //$scope.total_weight += ($('#qty').val()*$scope.user.weight);
                        return;
                    }
                    else
                    {
                        $scope.msg = "";
                    }
                    console.log($scope.total_weight)
                    val = $('#doc_type').val();
                    if(val == 'parcel')
                    {
                        $('#parcel_div').css('display', 'block')
                        $('#doc_div').css('display', 'none')
                    }
                    else if(val == 'document')
                    {
                        $('#parcel_div').css('display', 'none')
                        $('#doc_div').css('display', 'block')
                    }

                    $http.get(app.host + 'getCouriersList').then(function(response){
                        $scope.couriers = response.data.couriers;
                    })
                    $scope.total_qty += Number($('#qty').val());
                    if($scope.user.item == "Your document description")
                        item_title = $scope.user.other_item
                    else
                        item_title = $scope.user.item
                    if($scope.items)
                    {
                        var item = $scope.items;

                        $scope.items[$scope.items.length] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
                        $scope.items =  $scope.items;
                    }
                    else
                    {
                        items[n] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
                        $scope.items = items;
                    }
                    // items[n] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
                    // $scope.items = items;
                    $scope.total_price = $scope.total_qty*$scope.unit_price;
                    console.log('****')
                    console.log($scope.items)
                    $scope.total_items = $scope.num_of_item
                    $scope.total_weight = Math.floor($scope.total_weight);

                    var data = $.param({
                        from: sender_dist,
                        to: receiver_dist,
                        total_weight: $scope.total_weight,
                    });
                    var config = {
                        headers : {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    };

                    if(val == 'parcel')
                    {
                        $http.post(app.host + 'getPriceQuotion', data, config).success(function (result, status) {

                            console.log('--+++++++++++-')
                            console.log(result)
                            if(result == -1)
                            {
                                $scope.msg = "Price quotation not available for this route/weight.";
                                $scope.total_weight = 0;
                                items[n] = new Array();
                                delete $scope.items;

                                $('#sender_district').attr('disabled', false);
                                $('#receiver_district').attr('disabled', false);
                                return;
                            }
                            else{
                                $scope.prices = result;
                            }


                        }).error(function (result, status) {
                            console.log(result)
                        });
                    }

                    n++;
                }


            }).error(function (result, status) {
                console.log(result)
            });
        }
        else if(doc_type == 'document')
        {
            $('#parcel_div').css('display', 'none')
            $('#doc_div').css('display', 'block')

            $scope.total_qty += Number($('#qty').val());
            if($scope.user.item == "Your document description")
                item_title = $scope.user.other_item
            else
                item_title = $scope.user.item
            if($scope.items)
            {
                var item = $scope.items;

                $scope.items[$scope.items.length] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
                $scope.items =  $scope.items;
            }
            else
            {
                items[n] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
                $scope.items = items;
            }
            // items[n] = [ item_title, $scope.user.item, $scope.user.weight, $('#qty').val(), $scope.user.item, $scope.user.item];
            // $scope.items = items;
            $scope.total_price = $scope.total_qty*$scope.unit_price;
            console.log('****')
            console.log($scope.items)
            $scope.total_items = $scope.num_of_item
        }

    }
    $scope.removeItem = function (key, weight) {
        //alert('d')
        $scope.items.splice(key,1);
        $scope.total_items = $scope.items.length;
        $scope.total_weight -= Number(weight);
        console.log($scope.items)

        n--;
    }

})
angular.module('myApp').controller('CourierController', function($scope, $http, $window) {
    $scope.loadCouriersList = function(){
        $http.get(app.host + 'getCouriersList').then(function(response){
            $scope.couriers = response.data.couriers;
        })
    }
    $scope.courier_details = function (id) {
        $http.get(app.host + 'dashboard/get_courier/'+id).then(function(response){
            $scope.courier = response.data.courier;
        })
    }

    var references = new Array();
    var experiences = new Array();
    var n=0;
    var i=0;
    $scope.references = {};
    $scope.experiences = {};
    $scope.add_referee = function(){
        $('#modalSlideUp').modal('toggle');
        references[n] = [$scope.referee.referee_name, $scope.referee.referee_company, $scope.referee.referee_designation, $scope.referee.referee_email, $scope.referee.referee_contact]
        n++
        console.log(references)
        $scope.referee = {}
        $scope.references = references;
        $('#references').val(references)
    }
    $scope.add_experience = function(){
        $('#modalSlideUpExperience').modal('toggle');
        experiences[i] = [$scope.exp.company, $scope.exp.designation, $scope.exp.start_date, $scope.exp.end_date]
        i++
        $scope.exp = {}
        $scope.experiences = experiences;
        $('#experiences').val(experiences)
    }
})
