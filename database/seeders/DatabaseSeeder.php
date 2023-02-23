<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([

        ]);
        $this->importSizes();
        $this->importSuppliers();
        $this->importUsers();
    }
    public function importSizes(){
        $sizes = ['XS','S','M',"L","XL","XXL","XXXL"];
        foreach($sizes as  $size){
            DB::table('sizes')->insert([
                'name' => $size,
                'created_at' => now()
            ]);
        }
    }
    public function importSuppliers(){
        $name =['Nguyễn Thị Hồng','Trần Văn Minh','Lê Thị Thu','Đỗ Văn Hiếu','Hoàng Văn Tâm','Phạm Thị Hương','Vũ Thị Lan Anh','Ngô Thị Ngọc Anh','Trần Thanh Tùng','Lý Thanh Hải'];
        $email =['nguyenthihong@example.com','tranvanminh@example.com','lethithu@example.com','dovanhieu@example.com','hoangvantam@example.com','phamthihu@example.com','vuthilananh@example.com','ngothingocanh@example.com','tranthanhtung@example.com','lythanhhai@example.com'];
        $address =['Cam Lộ - Quảng Trị','Cam Thủy - Quảng Trị','Cam Thành - Quảng Trị','Cam An - Quảng Trị','Cảnh Dương - Quảng Bình','Đô Lương - Nghệ An','Bến Cầu - Tây Ninh','Tiên Yên - Quảng Ninh','Kim Bảng - Hà Nam','Quận Tân Bình - TP Hồ Chí Minh'];
        $phone =['0918765432','0912384761','0914638290','0916847039','0919582301','0917102354','0913478162','0915029374','0917256803','0918817765'];
        foreach($name as $key => $item){
            DB::table('suppliers')->insert([
                'name' => $item,
                'email' => $email[$key],
                'address' => $address[$key],
                'phone' => $phone[$key],
                'created_at' => now()
            ]);
        }
    }
    public function importUsers(){
            DB::table('users')->insert([
                'name' => 'Mai Xuân Cường',
                'password' => bcrypt('123456'),
                'phone' => '0843442357',
                'birthday' => '29/06/2002',
                'image' => 'null',
                'gender' => 'Nam',
                'email' => 'maixuancuong@gmail.com',
                'province_id' => '74',
                'district_id' => '700',
                'ward_id' => '6555',
                'created_at' => now()
            ]);
    }
}
