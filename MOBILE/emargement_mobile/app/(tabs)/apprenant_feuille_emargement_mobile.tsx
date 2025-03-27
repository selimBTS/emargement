import React from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Image } from 'react-native';
import { Ionicons } from '@expo/vector-icons';

export default function ApprenantFeuilleEmargementMobile() {
  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.avatar}><Text style={styles.avatarText}>AK</Text></View>
        <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      </View>

      <View style={styles.rowBetween}>
        <Text style={styles.welcome}>Bonjour Apprenant</Text>
        <TouchableOpacity style={styles.absenceBtn}>
          <Text style={styles.absenceBtnText}>Justifier une absence</Text>
        </TouchableOpacity>
      </View>

      <Text style={styles.sectionTitle}>ANGLAIS</Text>

      <View style={styles.card}>
        <Ionicons name="book" size={16} color="#0E1E5B" />
        <Text style={styles.cardText}>anglais salle C</Text>
        <Text style={styles.cardTime}>17h15 - 18h00</Text>
        <Text style={styles.cardProf}>👤 Intervenant</Text>
        <Text style={styles.profName}>Nom prof</Text>
      </View>

      <TouchableOpacity style={styles.signBtn}>
        <Text style={styles.signBtnText}>Signer</Text>
      </TouchableOpacity>

      <View style={styles.footer}>
        <TouchableOpacity><Text style={styles.footerItem}>🏠\nAccueil</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>📅\nCalendrier</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>👤\nProfil</Text></TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F1F3F5',
    paddingTop: 40,
    paddingHorizontal: 20
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 10
  },
  avatar: {
    backgroundColor: '#E85421',
    width: 40,
    height: 40,
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center'
  },
  avatarText: {
    color: 'white',
    fontWeight: 'bold'
  },
  logo: {
    width: 100,
    height: 30,
    resizeMode: 'contain'
  },
  rowBetween: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 10
  },
  welcome: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#0E1E5B'
  },
  absenceBtn: {
    backgroundColor: '#0E1E5B',
    borderRadius: 8,
    paddingHorizontal: 12,
    paddingVertical: 6
  },
  absenceBtnText: {
    color: 'white',
    fontWeight: '600'
  },
  sectionTitle: {
    backgroundColor: '#dee2e6',
    padding: 10,
    fontWeight: 'bold',
    color: '#212529',
    fontSize: 16,
    marginBottom: 10
  },
  card: {
    backgroundColor: '#fff',
    borderRadius: 12,
    padding: 15,
    marginBottom: 20,
    shadowColor: '#000',
    shadowOpacity: 0.1,
    shadowOffset: { width: 0, height: 2 },
    shadowRadius: 4,
    elevation: 3,
  },
  cardText: {
    fontWeight: '600',
    fontSize: 14,
    marginTop: 10
  },
  cardTime: {
    color: '#6C757D',
    marginTop: 4
  },
  cardProf: {
    fontWeight: 'bold',
    marginTop: 10,
    color: '#212529'
  },
  profName: {
    color: '#212529'
  },
  signBtn: {
    backgroundColor: '#0E1E5B',
    padding: 15,
    borderRadius: 8,
    alignItems: 'center',
    marginBottom: 20
  },
  signBtnText: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 16
  },
  footer: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    paddingVertical: 10,
    borderTopWidth: 1,
    borderColor: '#ccc',
    backgroundColor: '#fff'
  },
  footerItem: {
    textAlign: 'center',
    fontSize: 12,
    color: '#212529'
  }
});