<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id' => '1',
                'name' => 'user-list',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.index',
            ], [
                'id' => '2',
                'name' => 'user-create',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.create,dashboard.users.store',
            ], [
                'id' => '3',
                'name' => 'user-edit',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.edit,dashboard.users.update',
            ], [
                'id' => '4',
                'name' => 'user-delete',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.destroy',
            ], [
                'id' => '5',
                'name' => 'user-show',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.show',
            ], [
                'id' => '6',
                'name' => 'user-showProfile',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.showProfile',
            ], [
                'id' => '7',
                'name' => 'user-profile',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'dashboard.users.profile',
            ], [
                'id' => '9',
                'name' => 'role-list',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'dashboard.roles.index',
            ], [
                'id' => '10',
                'name' => 'role-create',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'dashboard.roles.create,dashboard.roles.store',
            ], [
                'id' => '11',
                'name' => 'role-edit',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'dashboard.roles.edit,dashboard.roles.update',
            ], [
                'id' => '12',
                'name' => 'role-delete',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'dashboard.roles.destroy',
            ], [
                'id' => '13',
                'name' => 'role-show',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'dashboard.roles.show',
            ], [
                'id' => '14',
                'name' => 'setting-list',
                'display_name' => 'الإعدادات',
                'guard_name' => 'web',
                'routes' => 'dashboard.settings.index',
            ], [
                'id' => '15',
                'name' => 'setting-edit',
                'display_name' => 'الإعدادات',
                'guard_name' => 'web',
                'routes' => 'dashboard.settings.update',
            ], [
                'id' => '16',
                'name' => 'dashboard-index',
                'display_name' => 'الرئيسيه',
                'guard_name' => 'web',
                'routes' => 'dashboard.index',
            ], [
                'id' => '17',
                'name' => 'specialty-list',
                'display_name' => 'التخصصات',
                'guard_name' => 'web',
                'routes' => 'dashboard.specialties.index',
            ], [
                'id' => '18',
                'name' => 'specialty-create',
                'display_name' => 'التخصصات',
                'guard_name' => 'web',
                'routes' => 'dashboard.specialties.create,dashboard.specialties.store',
            ], [
                'id' => '19',
                'name' => 'specialty-edit',
                'display_name' => 'التخصصات',
                'guard_name' => 'web',
                'routes' => 'dashboard.specialties.edit,dashboard.specialties.update',
            ], [
                'id' => '20',
                'name' => 'specialty-delete',
                'display_name' => 'التخصصات',
                'guard_name' => 'web',
                'routes' => 'dashboard.specialties.destroy',
            ], [
                'id' => '21',
                'name' => 'examination-list',
                'display_name' => 'الفحوصات - الكشوفات',
                'guard_name' => 'web',
                'routes' => 'dashboard.examinations.index',
            ], [
                'id' => '22',
                'name' => 'examination-create',
                'display_name' => 'الفحوصات - الكشوفات',
                'guard_name' => 'web',
                'routes' => 'dashboard.examinations.create,dashboard.examinations.store',
            ], [
                'id' => '23',
                'name' => 'examination-edit',
                'display_name' => 'الفحوصات - الكشوفات',
                'guard_name' => 'web',
                'routes' => 'dashboard.examinations.edit,dashboard.examinations.update',
            ], [
                'id' => '24',
                'name' => 'examination-delete',
                'display_name' => 'الفحوصات - الكشوفات',
                'guard_name' => 'web',
                'routes' => 'dashboard.examinations.destroy',
            ], [
                'id' => '25',
                'name' => 'doctor-list',
                'display_name' => 'الاطباء',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctors.index',
            ], [
                'id' => '26',
                'name' => 'doctor-create',
                'display_name' => 'الاطباء',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctors.create,dashboard.doctors.store',
            ], [
                'id' => '27',
                'name' => 'doctor-edit',
                'display_name' => 'الاطباء',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctors.edit,dashboard.doctors.update',
            ], [
                'id' => '28',
                'name' => 'doctor-delete',
                'display_name' => 'الاطباء',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctors.destroy',
            ], [
                'id' => '29',
                'name' => 'doctor-show',
                'display_name' => 'الاطباء',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctors.show',
            ], [
                'id' => '30',
                'name' => 'workday-list',
                'display_name' => 'ايام العمل',
                'guard_name' => 'web',
                'routes' => 'dashboard.workdays.index',
            ], [
                'id' => '31',
                'name' => 'workday-create',
                'display_name' => 'ايام العمل',
                'guard_name' => 'web',
                'routes' => 'dashboard.workdays.create,dashboard.workdays.store',
            ], [
                'id' => '32',
                'name' => 'workday-edit',
                'display_name' => 'ايام العمل',
                'guard_name' => 'web',
                'routes' => 'dashboard.workdays.edit,dashboard.workdays.update',
            ], [
                'id' => '33',
                'name' => 'workday-delete',
                'display_name' => 'ايام العمل',
                'guard_name' => 'web',
                'routes' => 'dashboard.workdays.destroy',
            ], [
                'id' => '34',
                'name' => 'price-list',
                'display_name' => 'اسعار الفحص',
                'guard_name' => 'web',
                'routes' => 'dashboard.prices.index',
            ], [
                'id' => '35',
                'name' => 'price-create',
                'display_name' => 'اسعار الفحص',
                'guard_name' => 'web',
                'routes' => 'dashboard.workdays.create,dashboard.prices.store',
            ], [
                'id' => '36',
                'name' => 'price-edit',
                'display_name' => 'اسعار الفحص',
                'guard_name' => 'web',
                'routes' => 'dashboard.prices.edit,dashboard.prices.update',
            ], [
                'id' => '37',
                'name' => 'price-delete',
                'display_name' => 'اسعار الفحص',
                'guard_name' => 'web',
                'routes' => 'dashboard.prices.destroy',
            ], [
                'id' => '38',
                'name' => 'reservation-list',
                'display_name' => 'الحجوزات',
                'guard_name' => 'web',
                'routes' => 'dashboard.reservations.index',
            ], [
                'id' => '39',
                'name' => 'reservation-create',
                'display_name' => 'الحجوزات',
                'guard_name' => 'web',
                'routes' => 'dashboard.reservations.create,dashboard.reservations.store',
            ], [
                'id' => '40',
                'name' => 'reservation-edit',
                'display_name' => 'الحجوزات',
                'guard_name' => 'web',
                'routes' => 'dashboard.reservations.edit,dashboard.reservations.update',
            ], [
                'id' => '41',
                'name' => 'reservation-delete',
                'display_name' => 'الحجوزات',
                'guard_name' => 'web',
                'routes' => 'dashboard.reservations.destroy',
            ], [
                'id' => '42',
                'name' => 'reservation-show',
                'display_name' => 'الحجوزات',
                'guard_name' => 'web',
                'routes' => 'dashboard.reservations.show',
            ], [
                'id' => '43',
                'name' => 'complete',
                'display_name' => 'تاكيد الحجز',
                'guard_name' => 'web',
                'routes' => 'dashboard.complete',
            ], [
                'id' => '44',
                'name' => 'doctor',
                'display_name' => 'الطبيب',
                'guard_name' => 'web',
                'routes' => 'dashboard.doctor',
            ], [
                'id' => '45',
                'name' => 'day',
                'display_name' => 'اليوم',
                'guard_name' => 'web',
                'routes' => 'dashboard.day',
            ],
        ];


        Permission::insert($permissions);
    }
}
