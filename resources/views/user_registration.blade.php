<x-layout>
    <style>
        :root {
            --obsidian: #020406;
            --cold-cyan: #00f2ff;
            --midnight: #0a0c12;
            --border: rgba(0, 242, 255, 0.15);
            --text: #a0a0a0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        .nexus-wrapper { 
            background: radial-gradient(circle at 50% 50%, #10141d 0%, var(--obsidian) 100%);
            min-height: 100vh;
            font-family: 'Orbitron', sans-serif;
            color: var(--text);
            padding: 40px 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr; /* Matches your screenshot structure */
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .nexus-card {
            background: var(--midnight);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
            position: relative;
        }

        /* Neon Header Line */
        h2 { 
            color: var(--cold-cyan); 
            font-size: 0.75rem; 
            letter-spacing: 2px; 
            margin-bottom: 20px; 
            border-bottom: 1px solid var(--border); 
            padding-bottom: 10px; 
            text-transform: uppercase; 
        }

        /* Form Inputs Styling */
        input, textarea {
            background: #000 !important;
            border: 1px solid var(--border) !important;
            color: var(--cold-cyan) !important;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            margin-bottom: 12px;
            font-size: 0.7rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--cold-cyan) !important;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            outline: none;
        }

        /* Register Button */
        .nexus-btn {
            width: 100%;
            background: transparent;
            border: 1px solid var(--cold-cyan);
            color: var(--cold-cyan);
            padding: 14px;
            font-size: 0.75rem;
            letter-spacing: 2px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .nexus-btn:hover {
            background: var(--cold-cyan);
            color: var(--obsidian);
            box-shadow: 0 0 20px var(--cold-cyan);
        }

        /* User List Items */
        .user-log {
            background: rgba(0,0,0,0.4);
            border-left: 3px solid var(--cold-cyan);
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 4px;
        }

        .user-details .name { color: #fff; font-size: 0.8rem; display: block; }
        .user-details .meta { color: var(--text); font-size: 0.6rem; opacity: 0.6; }

        .del-btn {
            color: #ff3333;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0 10px;
        }
    </style>

    <div class="nexus-wrapper">
        <div class="dashboard-grid">
            
            <div class="nexus-card">
                <h2>Register_Users.exe</h2>
                
                <form action="/register-user" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <input type="text" name="first_name" placeholder="FIRST_NAME" required>
                        <input type="text" name="last_name" placeholder="LAST_NAME" required>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <input type="text" name="middle_name" placeholder="MIDDLE_NAME">
                        <input type="text" name="nickname" placeholder="ALIAS">
                    </div>

                    <input type="email" name="email" placeholder="NETWORK_ID_EMAIL" required>

                    <div style="display: grid; grid-template-columns: 80px 1fr; gap: 10px;">
                        <input type="number" name="age" placeholder="AGE">
                        <input type="text" name="contact_number" placeholder="COMMS_LINK">
                    </div>

                    <textarea name="address" placeholder="GEOGRAPHIC_LOCATION" rows="2"></textarea>

                    <button type="submit" class="nexus-btn">Initiate_Sync</button>
                </form>
            </div>

            <div class="nexus-card">
                <h2>Active_System_Logs // {{ $users->count() }} Users</h2>
                
                <div id="logContainer">
                    @foreach($users as $user)
                        <div class="user-log">
                            <div class="user-details">
                                <span class="name">{{ $user->first_name }} {{ $user->last_name }}</span>
                                <span class="meta">{{ $user->email }} | {{ $user->contact_number }}</span>
                            </div>
                            
                            <form action="/delete-user/{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="del-btn">×</button>
                            </form>
                        </div>
                    @endforeach

                    @if($users->isEmpty())
                        <div style="text-align: center; padding: 40px; color: #444; font-size: 0.7rem;">
                            [ NO_ACTIVE_RECORDS_FOUND ]
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-layout>