// Naufal Elghani C030324100
// Proyek: UAS-PPB_TI_3C_C030324100
// Pastikan menambahkan dependencies di pubspec.yaml:
// http: ^1.1.0
// shared_preferences: ^2.2.1

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'UAS PPB - Naufal Elghani',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const CheckAuthScreen(),
    );
  }
}

// ==========================================
// KONFIGURASI API
// ==========================================
// Gunakan 10.0.2.2 untuk emulator Android, atau IP Local (contoh 192.168.x.x) untuk device asli
const String baseUrl = 'http://127.0.0.1:8000/api';

// ==========================================
// SCREEN: CEK AUTENTIKASI (Splash)
// ==========================================
class CheckAuthScreen extends StatefulWidget {
  const CheckAuthScreen({Key? key}) : super(key: key);

  @override
  _CheckAuthScreenState createState() => _CheckAuthScreenState();
}

class _CheckAuthScreenState extends State<CheckAuthScreen> {
  @override
  void initState() {
    super.initState();
    _checkToken();
  }

  Future<void> _checkToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? token = prefs.getString('token');
    
    await Future.delayed(const Duration(seconds: 1)); // Efek loading sebentar
    
    if (token != null) {
      Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => const MainScreen()));
    } else {
      Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => const LoginScreen()));
    }
  }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(body: Center(child: CircularProgressIndicator()));
  }
}

// ==========================================
// SCREEN: LOGIN
// ==========================================
class LoginScreen extends StatefulWidget {
  const LoginScreen({Key? key}) : super(key: key);

  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  // Naufal Elghani C030324100
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  bool _isLoading = false;

  Future<void> _login() async {
    setState(() => _isLoading = true);
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/login'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'email': _emailController.text,
          'password': _passwordController.text,
        }),
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        SharedPreferences prefs = await SharedPreferences.getInstance();
        await prefs.setString('token', data['access_token']);
        
        if (mounted) {
          Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => const MainScreen()));
        }
      } else {
        _showError('Login gagal. Periksa email dan password.');
      }
    } catch (e) {
      _showError('Terjadi kesalahan koneksi: $e');
    } finally {
      setState(() => _isLoading = false);
    }
  }

  void _showError(String message) {
    ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text(message)));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Login - Naufal Elghani')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            TextField(
              controller: _emailController,
              decoration: const InputDecoration(labelText: 'Email', border: OutlineInputBorder()),
            ),
            const SizedBox(height: 16),
            TextField(
              controller: _passwordController,
              obscureText: true,
              decoration: const InputDecoration(labelText: 'Password', border: OutlineInputBorder()),
            ),
            const SizedBox(height: 24),
            _isLoading 
                ? const CircularProgressIndicator()
                : SizedBox(
                    width: double.infinity,
                    height: 45,
                    child: ElevatedButton(
                      onPressed: _login,
                      child: const Text('Login'),
                    ),
                  )
          ],
        ),
      ),
    );
  }
}

// ==========================================
// SCREEN: MAIN (Bottom Navigation)
// ==========================================
class MainScreen extends StatefulWidget {
  const MainScreen({Key? key}) : super(key: key);

  @override
  _MainScreenState createState() => _MainScreenState();
}

class _MainScreenState extends State<MainScreen> {
  int _currentIndex = 0;
  final List<Widget> _pages = [
    const PesanProdukScreen(),
    const RiwayatPesananScreen(),
  ];

  Future<void> _logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? token = prefs.getString('token');
    
    if (token != null) {
      await http.post(
        Uri.parse('$baseUrl/logout'),
        headers: {'Authorization': 'Bearer $token'},
      );
    }
    await prefs.remove('token');
    if (mounted) {
      Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => const LoginScreen()));
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('UAS-PPB_TI_3C_C030324100', style: TextStyle(fontSize: 16)),
        actions: [
          IconButton(
            icon: const Icon(Icons.logout),
            onPressed: _logout,
            tooltip: 'Logout',
          )
        ],
      ),
      body: _pages[_currentIndex],
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _currentIndex,
        onTap: (index) => setState(() => _currentIndex = index),
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.shopping_cart), label: 'Pesan Produk'),
          BottomNavigationBarItem(icon: Icon(Icons.history), label: 'Riwayat'),
        ],
      ),
    );
  }
}

// ==========================================
// SCREEN: PESAN PRODUK (Sesuai UI Referensi)
// ==========================================
class PesanProdukScreen extends StatefulWidget {
  const PesanProdukScreen({Key? key}) : super(key: key);

  @override
  State<PesanProdukScreen> createState() => _PesanProdukScreenState();
}

class _PesanProdukScreenState extends State<PesanProdukScreen> {
  // Naufal Elghani C030324100
  final _formKey = GlobalKey<FormState>();
  final _namaController = TextEditingController();
  final _emailController = TextEditingController();
  final _noHpController = TextEditingController();
  final _alamatController = TextEditingController();
  final _kotaController = TextEditingController();
  final _kodePosController = TextEditingController();
  
  String _selectedKodeProduk = 'DC 001';
  final List<String> _listKodeProduk = ['DC 001', 'DC 002', 'DC 003'];
  bool _isSubmitting = false;

  Future<void> _submitPesanan() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isSubmitting = true);
      SharedPreferences prefs = await SharedPreferences.getInstance();
      String? token = prefs.getString('token');

      try {
        final response = await http.post(
          Uri.parse('$baseUrl/orders'),
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer $token',
          },
          body: jsonEncode({
            'nama_lengkap': _namaController.text,
            'email': _emailController.text,
            'nomor_handphone': _noHpController.text,
            'alamat_lengkap': _alamatController.text,
            'kota': _kotaController.text,
            'kode_pos': _kodePosController.text,
            'kode_produk': _selectedKodeProduk,
          }),
        );

        if (response.statusCode == 201) {
          ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Pesanan berhasil dibuat!')));
          _clearForm();
        } else {
          ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Gagal membuat pesanan.')));
        }
      } catch (e) {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Error: $e')));
      } finally {
        setState(() => _isSubmitting = false);
      }
    }
  }

  void _clearForm() {
    _namaController.clear();
    _emailController.clear();
    _noHpController.clear();
    _alamatController.clear();
    _kotaController.clear();
    _kodePosController.clear();
    setState(() => _selectedKodeProduk = _listKodeProduk.first);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: Column(
        children: [
          // Header Aksesn Merah
          Container(height: 20, color: const Color(0xFFE3421B)),
          
          Expanded(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(16.0),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text('Pesan Produk', style: TextStyle(fontSize: 22, color: Color(0xFF4A4A4A))),
                    const Divider(thickness: 1, color: Colors.grey),
                    const SizedBox(height: 16),

                    _buildFormRow('Nama Lengkap*', _namaController),
                    _buildFormRow('Email *', _emailController),
                    _buildFormRow('Nomor Handphone*', _noHpController),
                    _buildFormRow('Alamat Lengkap *', _alamatController),
                    
                    // Row khusus Kota & Kode Pos
                    Padding(
                      padding: const EdgeInsets.only(bottom: 12.0),
                      child: Row(
                        children: [
                          const SizedBox(width: 130), 
                          const Text('Kota * '),
                          Expanded(child: _buildTextField(_kotaController)),
                          const SizedBox(width: 8),
                          const Text('Kode Pos * '),
                          Expanded(child: _buildTextField(_kodePosController)),
                        ],
                      ),
                    ),

                    // Dropdown Kode Produk
                    Padding(
                      padding: const EdgeInsets.only(bottom: 12.0),
                      child: Row(
                        children: [
                          const SizedBox(width: 130, child: Text('Kode Produk*')),
                          const Text(': '),
                          Container(
                            height: 30,
                            padding: const EdgeInsets.symmetric(horizontal: 8),
                            decoration: BoxDecoration(border: Border.all(color: Colors.grey.shade400)),
                            child: DropdownButtonHideUnderline(
                              child: DropdownButton<String>(
                                value: _selectedKodeProduk,
                                items: _listKodeProduk.map((String value) {
                                  return DropdownMenuItem<String>(
                                    value: value,
                                    child: Text(value, style: const TextStyle(fontSize: 13)),
                                  );
                                }).toList(),
                                onChanged: (newValue) => setState(() => _selectedKodeProduk = newValue!),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),

                    const SizedBox(height: 16),
                    Padding(
                      padding: const EdgeInsets.only(top: 16.0),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.end, // Align ke kanan
                        children: [
                          // 1. Tombol Pesan
                          _isSubmitting
                              ? const SizedBox(width: 20, height: 20, child: CircularProgressIndicator(strokeWidth: 2))
                              : ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                    primary: Colors.grey.shade300,
                                    onPrimary: Colors.black,
                                    elevation: 1,
                                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(2)),
                                  ),
                                  onPressed: _submitPesanan,
                                  child: const Text('Pesan', style: TextStyle(fontSize: 12)),
                                ),
                          
                          const SizedBox(width: 10), // Spasi antar tombol
                          
                          // 2. Tombol Batal
                          ElevatedButton(
                            style: ElevatedButton.styleFrom(
                              primary: Colors.grey.shade300,
                              onPrimary: Colors.black,
                              elevation: 1,
                              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(2)),
                            ),
                            onPressed: _clearForm,
                            child: const Text('Batal', style: TextStyle(fontSize: 12)),
                          ),
                        ],
                      ),
                    ),
                    
                    const SizedBox(height: 40),
                  ],
                ),
              ),
            ),
          ),
          
          // Footer Biru
          Container(
            width: double.infinity,
            padding: const EdgeInsets.all(16.0),
            color: const Color(0xFF1971A8),
            child: const Text('Cara Pemesanan', style: TextStyle(color: Colors.white, fontSize: 18)),
          ),
        ],
      ),
    );
  }

  Widget _buildFormRow(String label, TextEditingController controller) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          SizedBox(width: 130, child: Text(label)),
          const Text(': '),
          Expanded(child: _buildTextField(controller)),
        ],
      ),
    );
  }

  Widget _buildTextField(TextEditingController? controller, {bool enabled = true}) {
    return SizedBox(
      height: 28,
      child: TextFormField(
        controller: controller,
        enabled: enabled,
        style: const TextStyle(fontSize: 13),
        decoration: InputDecoration(
          contentPadding: const EdgeInsets.symmetric(horizontal: 8, vertical: 0),
          border: OutlineInputBorder(borderRadius: BorderRadius.circular(2), borderSide: BorderSide(color: Colors.grey.shade400)),
          enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(2), borderSide: BorderSide(color: Colors.grey.shade400)),
          focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(2), borderSide: const BorderSide(color: Colors.blue)),
        ),
        validator: enabled ? (value) => (value == null || value.isEmpty) ? '!' : null : null,
      ),
    );
  }
}

// ==========================================
// SCREEN: RIWAYAT PESANAN
// ==========================================
class RiwayatPesananScreen extends StatefulWidget {
  const RiwayatPesananScreen({Key? key}) : super(key: key);

  @override
  _RiwayatPesananScreenState createState() => _RiwayatPesananScreenState();
}

class _RiwayatPesananScreenState extends State<RiwayatPesananScreen> {
  List<dynamic> _orders = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _fetchOrders();
  }

  Future<void> _fetchOrders() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? token = prefs.getString('token');

    try {
      final response = await http.get(
        Uri.parse('$baseUrl/orders'),
        headers: {'Authorization': 'Bearer $token'},
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        setState(() {
          _orders = data['data'];
          _isLoading = false;
        });
      }
    } catch (e) {
      setState(() => _isLoading = false);
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Error: $e')));
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : _orders.isEmpty
              ? const Center(child: Text('Belum ada riwayat pesanan.'))
              : ListView.builder(
                  itemCount: _orders.length,
                  itemBuilder: (context, index) {
                    final order = _orders[index];
                    return Card(
                      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                      child: ListTile(
                        leading: const CircleAvatar(child: Icon(Icons.shopping_bag)),
                        title: Text('Produk: ${order['kode_produk']}'),
                        subtitle: Text('Penerima: ${order['nama_lengkap']}\nTanggal: ${order['created_at'].toString().split('T')[0]}'),
                        isThreeLine: true,
                      ),
                    );
                  },
                ),
    );
  }
}