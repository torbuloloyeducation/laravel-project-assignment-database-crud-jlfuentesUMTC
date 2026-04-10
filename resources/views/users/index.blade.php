<x-layout title="User Registration">
    <style>
        :root {
            --nexus-bg: #0a0c12;
            --nexus-panel: #111827;
            --nexus-border: rgba(0, 255, 200, 0.2);
            --nexus-accent: #00f2ff;
            --nexus-danger: #ef4444;
            --nexus-text: #cbd5e1;
        }

        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        body { font-family: 'Orbitron', sans-serif; }

        .nexus-body {
            background: radial-gradient(circle at 50% 50%, #0f172a 0%, var(--nexus-bg) 100%);
            min-height: 100vh;
            padding: 40px 20px;
            color: var(--nexus-text);
        }

        .nexus-card {
            background: var(--nexus-panel);
            border: 1px solid var(--nexus-border);
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 255, 200, 0.15);
            overflow: hidden;
            margin-bottom: 30px;
        }

        h1, h2 { color: var(--nexus-accent); letter-spacing: 2px; }

        .form-input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--nexus-border);
            background: #000;
            color: var(--nexus-accent);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--nexus-accent);
            box-shadow: 0 0 10px rgba(0, 255, 200, 0.3);
        }

        .btn-primary {
            background: var(--nexus-accent);
            color: #000;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover { background: #06b6d4; box-shadow: 0 0 15px var(--nexus-accent); }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-edit {
            background: rgba(0, 255, 200, 0.1);
            color: var(--nexus-accent);
            border: 1px solid var(--nexus-border);
        }
        .btn-edit:hover { background: rgba(0, 255, 200, 0.25); }

        .btn-delete {
            background: rgba(239,68,68,0.15);
            color: var(--nexus-danger);
            border: 1px solid rgba(239,68,68,0.35);
        }
        .btn-delete:hover { background: rgba(239,68,68,0.35); color: #fff; }

        table { width: 100%; font-size: 0.85rem; }
        th { color: var(--nexus-accent); text-transform: uppercase; font-size: 0.7rem; letter-spacing: 2px; border-bottom: 1px solid var(--nexus-border); padding-bottom: 8px; }
        td { padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        tr:hover { background: rgba(0,255,200,0.05); }
    </style>

    <div class="nexus-body max-w-5xl mx-auto">

        {{-- TOP: Registration Form --}}
        <div class="nexus-card p-7">
            <h1 class="text-xl font-bold mb-4">Register User</h1>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <input class="form-input" type="text" name="first_name" placeholder="First Name" required>
                    <input class="form-input" type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input class="form-input" type="text" name="middle_name" placeholder="Middle Name">
                    <input class="form-input" type="text" name="nickname" placeholder="Nickname">
                </div>
                <input class="form-input" type="email" name="email" placeholder="Email" required>
                <div class="grid grid-cols-2 gap-4">
                    <input class="form-input" type="number" name="age" placeholder="Age" min="1">
                    <input class="form-input" type="text" name="contact_number" placeholder="Contact Number">
                </div>
                <textarea class="form-input" name="address" placeholder="Address" rows="3"></textarea>
                <button class="btn-primary" type="submit">Register User</button>
            </form>
        </div>

        {{-- BELOW: Users Table --}}
        <div class="nexus-card p-7">
            <h2 class="text-xl font-bold mb-4">Registered Users</h2>
            @if($users->isEmpty())
                <p class="text-center text-indigo-300 opacity-60 py-10 text-sm">No users registered yet.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-white font-medium">
                                {{ $user->last_name }}, {{ $user->first_name }}
                                @if($user->middle_name)
                                    <span class="text-xs text-indigo-300 block opacity-60">{{ $user->middle_name }}</span>
                                @endif
                            </td>
                            <td>{{ $user->nickname ?? '—' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->age ?? '—' }}</td>
                            <td>{{ $user->contact_number ?? '—' }}</td>
                            <td>{{ $user->address ?? '—' }}</td>
                            <td>
                                <div class="flex gap-2 items-center">
                                    <a class="btn-edit" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete" type="submit"
                                            onclick="return confirm('Delete {{ $user->first_name }}?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-layout>