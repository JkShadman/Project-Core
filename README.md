# Premier League Fantasy - Laravel Desktop App Clone

A complete desktop web application clone of the Premier League Fantasy app built with Laravel MVC architecture.

## 🚀 Features Implemented

### ✅ Requirement 1: View All Premier League Players
- **Player Listing**: Complete player database with all Premier League players
- **Player Details**: Name, position, team, price, points, stats, and photos
- **Search & Filter**: Filter by position, team, price range
- **Responsive Design**: Desktop-optimized interface

### ✅ Requirement 2: Create Fantasy Team
- **Team Creation**: Select exactly 11 players with constraints
- **Budget Management**: £100m budget with real-time validation
- **Position Limits**: 1 GK, 3-5 DEF, 3-5 MID, 1-3 FWD
- **Team Limits**: Max 3 players per team
- **Captain/Vice-Captain**: Designation system

### ✅ Requirement 3: Weekly Transfers
- **Transfer System**: Make changes before each gameweek
- **Transfer Limits**: 1 free transfer per gameweek
- **Point Deductions**: -4 points for extra transfers
- **Transfer Tracking**: History and remaining transfers

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 10.x (MVC Architecture)
- **Language**: PHP 8.x
- **Database**: MySQL 8.x
- **Authentication**: Laravel Sanctum

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Bootstrap 5
- **JavaScript**: Vanilla JS
- **Responsive**: Desktop-optimized

## 📁 Project Structure

```
premier-league-fantasy-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PlayerController.php
│   │   │   ├── TeamController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Player.php
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_players_table.php
│   │   ├── 2024_01_01_000002_create_users_table.php
│   │   └── 2024_01_01_000003_create_user_players_table.php
│   └── seeders/
│       └── PlayersTableSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── players/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── team/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── transfers.blade.php
│   └── css/
│   └── js/
├── routes/
│   └── web.php
└── .env
```

## 🚀 Quick Start

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 4. Start Development Server
```bash
php artisan serve
```

## 📊 Database Schema

### Players Table
- `id` - Primary key
- `name` - Player name
- `position` - Position (Goalkeeper, Defender, Midfielder, Forward)
- `team` - Premier League team
- `price` - Fantasy price in millions
- `total_points` - Total fantasy points
- `goals_scored` - Goals scored
- `assists` - Assists provided
- `clean_sheets` - Clean sheets (for defenders/goalkeepers)
- `minutes_played` - Minutes played
- `influence` - Influence rating
- `photo_url` - Player photo URL

### Users Table
- `id` - Primary key
- `name` - User name
- `email` - Email address
- `budget` - Fantasy budget (default: £100m)
- `transfers_remaining` - Free transfers left (default: 1)
- `total_points` - Total fantasy points

### User_Players Table (Pivot)
- `user_id` - Foreign key to users
- `player_id` - Foreign key to players
- `is_captain` - Captain designation
- `is_vice_captain` - Vice-captain designation

## 🔧 Configuration

### Environment Variables
```env
APP_NAME="Premier League Fantasy"
DB_DATABASE=premier_league_fantasy
```

### Key Features
- **MVC Architecture**: Clean separation of concerns
- **Authentication**: Laravel built-in auth system
- **Validation**: Form validation for all inputs
- **Security**: CSRF protection, XSS prevention
- **Responsive**: Desktop-optimized design
- **Performance**: Eager loading, query optimization

## 🎯 Usage

### For Users
1. **Register/Login**: Create account or login
2. **Browse Players**: View all available Premier League players
3. **Create Team**: Select 11 players within budget constraints
4. **Manage Transfers**: Make weekly changes to your team
5. **Track Performance**: Monitor points and rankings

### For Developers
- **Extend Features**: Add new player stats, teams, or gameweeks
- **Customize Rules**: Modify transfer limits, budget, or scoring
- **Add Features**: Implement new features like leagues or chips

## 📈 Performance Optimizations

- **Database Indexing**: Optimized queries for player searches
- **Caching**: Laravel cache for frequently accessed data
- **Pagination**: Efficient player listing
- **Lazy Loading**: Optimized relationship loading

## 🧪 Testing

```bash
php artisan test
```

## 📚 Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc)

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
