@extends('layouts.app')

@section('content')
<div data-ng-app="myApp" data-ng-controller="myCtrl" ng-init="init()">
        <div>
        Provinces:
            <select id="provinces" ng-model="provincessource" ng-options="provinces for (provinces, cities) in userAddress"
                ng-change="GetSelectedProvinces()">
                <option value=''>Select</option>
            </select>
        </div>
        <div style='height: 15px;'>
            &nbsp;</div>
        <div>
        Cities:
        <select id="cities" ng-disabled="!provincessource" ng-model="citiessource" ng-options="cities for (cities,districts) in provincessource"
                ng-change="GetSelectedCities()"><option value=''>Select</option>
            </select>
        </div>
        <div style='height: 15px;'>
            &nbsp;</div>
        <div>
        Districts:
        <select id="districts" ng-disabled="!provincessource || !citiessource" ng-model="districtssource" ng-options="districts for (districts,villages) in citiessource"
                ng-change="GetSelecteddistricts()"><option value=''>Select</option>
            </select>
        </div>
        <div style='height: 15px;'>
            &nbsp;</div>
        <div>
        Villages:
        <select id="villages" ng-disabled="!provincessource || !citiessource" ng-model="villagessource" ng-options="villages for villages in districtssource"
                ng-change="GetSelectedvillages()"><option value=''>Select</option>
            </select>
        </div>
        <div style='height: 15px;'>
            &nbsp;</div>
        <div>
       
        

@endsection

@push('scripts')
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {

    $scope.userAddress = null;

    $scope.init = function()
    {
        $scope.getInformation();
    }

    $scope.getInformation = function()
    {
        $http({
            method : 'GET',
            url    : '/api/address'

        }).then(function(response)
            {
                $scope.userAddress = response.data;
                
            }
        )
    }
    console.log($scope.userAddress);
    $scope.GetSelectedProvinces = function () {
                $scope.strProvinces = $scope.provincessource;
            };
    $scope.GetSelectedCities = function () {
                $scope.strCities = $scope.citiessource;
    };
    $scope.GetSelecteddistricts = function () {
                $scope.strDistricts = $scope.districtssource;
    }; 
});
</script>
@endpush