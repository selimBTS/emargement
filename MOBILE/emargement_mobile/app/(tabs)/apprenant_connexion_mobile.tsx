import React from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Image } from 'react-native';
import CheckBox from '@react-native-community/checkbox';

export default function ApprenantConnexionMobile() {
  const [email, setEmail] = React.useState('');
  const [password, setPassword] = React.useState('');
  const [remember, setRemember] = React.useState(false);

  const handleLogin = () => {
    // logique de connexion à venir
    console.log('Email:', email);
    console.log('Password:', password);
    console.log('Remember me:', remember);
  };

  return (
    <View style={styles.container}>
      <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      <Text style={styles.label}>EMAIL</Text>
      <TextInput
        style={styles.input}
        placeholder="Entrer votre email"
        value={email}
        onChangeText={setEmail}
        keyboardType="email-address"
        autoCapitalize="none"
      />

      <Text style={styles.label}>MOT DE PASSE</Text>
      <TextInput
        style={styles.input}
        placeholder="Entrer votre mot de passe"
        secureTextEntry
        value={password}
        onChangeText={setPassword}
      />

      <View style={styles.checkboxContainer}>
        <CheckBox
          value={remember}
          onValueChange={setRemember}
        />
        <Text style={styles.checkboxLabel}>Se souvenir de moi ?</Text>
      </View>

      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Connexion</Text>
      </TouchableOpacity>

      <Text style={styles.link}>Mot de passe oublié ?</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#0E1E5B',
    padding: 20,
    justifyContent: 'center',
  },
  logo: {
    width: 180,
    height: 60,
    alignSelf: 'center',
    marginBottom: 30,
    resizeMode: 'contain'
  },
  label: {
    color: '#fff',
    fontWeight: 'bold',
    marginTop: 10,
  },
  input: {
    backgroundColor: '#fff',
    borderRadius: 5,
    padding: 10,
    marginTop: 5,
  },
  checkboxContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginTop: 10,
  },
  checkboxLabel: {
    color: '#fff',
    marginLeft: 8,
  },
  button: {
    backgroundColor: '#E85421',
    padding: 15,
    borderRadius: 8,
    marginTop: 20,
  },
  buttonText: {
    textAlign: 'center',
    color: '#fff',
    fontWeight: 'bold',
    fontSize: 16,
  },
  link: {
    color: '#fff',
    textAlign: 'center',
    marginTop: 15,
    textDecorationLine: 'underline'
  }
});
