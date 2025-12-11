users:
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id('id_user');
        $table->string('nama_user');
        $table->string('username')->unique();
        $table->string('password');
        $table->enum('role', ['admin', 'bendahara']);
        $table->timestamps();
    });
}

siswa:
public function up()
{
    Schema::create('siswa', function (Blueprint $table) {
        $table->id('id_siswa');
        $table->string('nis')->unique();
        $table->string('nama');
        $table->string('kelas');
        $table->text('alamat')->nullable();
        $table->string('no_hp')->nullable();
        $table->boolean('status_aktif')->default(true);
        $table->timestamps();
    });
}

spp:
public function up()
{
    Schema::create('spp', function (Blueprint $table) {
        $table->id('id_spp');
        $table->string('tahun_ajaran');
        $table->integer('nominal');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

tagihan:
public function up()
{
    Schema::create('tagihan', function (Blueprint $table) {
        $table->id('id_tagihan');
        $table->foreignId('id_siswa')->constrained('siswa')->cascadeOnDelete();
        $table->foreignId('id_spp')->constrained('spp')->cascadeOnDelete();
        
        $table->string('bulan');
        $table->year('tahun');
        $table->integer('total_tagihan');
        
        $table->enum('status_pembayaran', ['belum', 'lunas'])->default('belum');
        $table->timestamps();
    });
}


pembayaran:
public function up()
{
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran');

        $table->foreignId('id_tagihan')->constrained('tagihan')->cascadeOnDelete();
        $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();

        $table->date('tanggal_bayar');
        $table->integer('jumlah_bayar');
        $table->string('metode_pembayaran')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

model user:
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'nama_user', 'username', 'password', 'role'
    ];

    protected $hidden = ['password'];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_user');
    }
}

model siswa:
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_siswa';
    protected $table = 'siswa';

    protected $fillable = [
        'nis', 'nama', 'kelas', 'alamat', 'no_hp', 'status_aktif'
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_siswa');
    }
}


model spp:
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_spp';
    protected $table = 'spp';

    protected $fillable = [
        'tahun_ajaran', 'nominal', 'deskripsi'
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_spp');
    }
}


model tagihan:
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tagihan';
    protected $table = 'tagihan';

    protected $fillable = [
        'id_siswa', 'id_spp', 'bulan', 'tahun', 
        'total_tagihan', 'status_pembayaran'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihan');
    }
}


model pembayaran:
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_tagihan', 'id_user', 'tanggal_bayar', 
        'jumlah_bayar', 'metode_pembayaran', 'keterangan'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
